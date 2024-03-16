<?php declare(strict_types=1);

namespace eb\adm;

interface Query {

	public static function insert(string $table, array $columns, array $values): self;

	public static function update(string $table, array $set, array $where): self;

	public static function delete(string $table, array $where): self;

}