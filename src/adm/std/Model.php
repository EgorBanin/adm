<?php declare(strict_types=1);

namespace eb\adm\std;

use eb\adm;

class Model implements adm\Model {

	public const TEMPLATE_DEFAULT = __DIR__ . '/form.phtml';

	public function __construct(
		private string $title,
		private string $table,
		private array $fields,
		private string $pk,
		private string $template = self::TEMPLATE_DEFAULT,
	) {}

	public function form(string $method, string $action): string {
		ob_start();
		require $this->template;

		return ob_get_clean();
	}

	public function save(adm\Conn $conn): void {
		if ($this->fields[$this->pk]?->sqlValue() !== null) {
			$conn->update();
		} else {
			$fields = array_filter(
				$this->fields,
				fn($f) => $f !== $this->pk,
				ARRAY_FILTER_USE_KEY
			);
			$conn->insert(
				$this->table,
				array_keys($fields),
				array_map(static fn($f) => $f->sqlValue(), $fileds),
			);
		}
	}

	public function delete(adm\Conn $conn): void {
		$conn->delete(
			$this->table,
			[
				$this->pk => $this->fields[$this->pk]?->sqlValue(),
			],
		);
	}
}