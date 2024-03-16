<?php declare(strict_types=1);

namespace eb\adm\std;

use eb\adm\Type;

class Field {

	public const TEMPLATE_DEFAULT = __DIR__ . '/field.phtml';

	private bool $changed = false;

	public function __construct(
		private string $label,
		private Type $type,
		private mixed $value,
		private bool $readonly = false,
		private string $template = self::TEMPLATE_DEFAULT,
	) {}

	public function input(string $name): string {
		ob_start();
		require $this->template;

		return ob_get_clean();
	}

	public function sqlValue(): mixed {
		return $this->value;
	}

}