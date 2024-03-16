<?php declare(strict_types=1);

namespace eb\adm;

interface Type {
	
	public function input(string $name, mixed $value, bool $readonly): string;

}