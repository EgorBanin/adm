<?php

require __DIR__ . '/../src/vendor/autoload.php';

use eb\adm\std;

$model = new std\Model(
	'test title',
	'test_table',
	[
		'foo' => new std\Field(
			'foo label',
			new std\Text(),
			'val',
		),
		'bar' => new std\Field(
			'bar label',
			new std\Text(true),
			'val',
			true,
		),
	],
);

echo $model->form('get', '/');
echo $model->save();