<?php declare(strict_types=1);

namespace eb\adm;

class Adm {

	public function __construct(
		private Conn $conn,
	) {}

	public static function auto(Conn $conn): self {
		return new self($conn);
	}

	public function run(): void {

	}

}