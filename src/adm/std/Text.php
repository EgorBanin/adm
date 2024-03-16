<?php declare(strict_types=1);

namespace eb\adm\std;

use eb\adm\Type;

class Text implements Type {

	public const TEMPLATE_DEFAULT = __DIR__ . '/text.phtml';

	public function __construct(
		private bool $multiline = false,
		private string $template = self::TEMPLATE_DEFAULT,
	) {}

	public function input(string $name, mixed $value, bool $readonly): string {
		ob_start();
		require $this->template;

		return ob_get_clean();
	}

}