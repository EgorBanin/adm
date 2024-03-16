<?php declare(strict_types=1);

class Password extends String {

	public function val(): string {
		return md5($this->val);
	}

}

$adm = \eb\adm\Adm::configure([
	'пользователь' => [
		'table' => 'users',
		'fields' => [
			'id' => 'id:int,readonly',
			'логин' => 'login:string(255),notEmpty',
			'пароль' => 'password:' . Password::class,
		],
	],
], $conn);
$adm->run();