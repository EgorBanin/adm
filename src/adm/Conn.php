<?php declare(strict_types=1);

namespace eb\adm;

interface Conn {

	public function query(string $q, array $params = []): ?array;
	
}