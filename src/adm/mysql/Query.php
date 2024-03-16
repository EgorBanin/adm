<?php declare(strict_types=1);

namespace eb\adm\mysql;

use eb\adm;

class Query implements adm\Query {

	public function __construct(
		private string $sql,
		private array $params,
	) {}

	public static function insert(string $table, array $columns, array $values): self {
		$sql = sprintf(
			'insert into %s (%s) values (%s);',
			self::q($table),
			implode(', ', array_map(self::q(...), $columns)),
			implode(', ', array_fill(0, count($columns), '?')),
		);

		return new self($sql, $values);
	}

	public static function update(string $table, array $set, array $where): self {
		$sql = sprintf(
			'update %s set %s where %s;',
			self::q($table),
			self::columns(array_keys($set), '%s = ?', ', '),
			self::columns(array_keys($where), '%s = ?', ' and '),
		);

		return new self($sql, array_merge(array_values($set), array_values($where)));
	}

	public static function delete(string $table, array $where): self {
		$sql = sprintf(
			'delete from %s where %s;',
			self::q($table),
			self::columns(array_keys($where), '%s = ?', ' and '),
		);

		return new self($sql, array_values($where));
	}

	public function execute(adm\Conn $conn): array {
		return $conn->query($this->sql, $this->params);
	}

	private static function q(string $id): string {
		return '`' . strtr($id, ['`', '``']) . '`';
	}

	private static function columns(array $columns, string $tpl, string $sep): string {
		return implode(
			$sep,
			array_map(
				static fn($w) => sprintf($tpl, self::q($w)),
				$columns,
			),
		);
	}

}