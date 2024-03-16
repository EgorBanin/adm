<?php declare(strict_types=1);

namespace tests\mysql;

use PHPUnit\Framework\TestCase;
use eb\adm\mysql\Query;

class QueryTest extends TestCase {

	public function testInsert() {
		$q = Query::insert('test', ['a', 'b'], [1, '2']);
		$this->assertEquals(new Query(
			'insert into `test` (`a`, `b`) values (?, ?);',
			[1, '2'],
		), $q);
	}

	public function testUpdate() {
		$q = Query::update('test', ['a' => 1, 'b' => '2'], ['id' => '3']);
		$this->assertEquals(new Query(
			'update `test` set `a` = ?, `b` = ? where `id` = ?;',
			[1, '2', '3'],
		), $q);
	}

	public function testDelete() {
		$q = Query::delete('test', ['id' => '3']);
		$this->assertEquals(new Query(
			'delete from `test` where `id` = ?;',
			['3'],
		), $q);
	}

}