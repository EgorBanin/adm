<?php declare(strict_types=1);

namespace eb\adm;

class AutoConfig {

	public function __construct(
		private Conn $conn,
	) {}
	
	public function __invoke() {
		$columns = $this->conn->query('
			select
				`tables`.`table_name`,
				`tables`.`table_comment`,
				`columns`.`column_name`,
				`columns`.`data_type`,
				`columns`.`is_nullable`,
				`columns`.`column_default`
			from `information_schema`.`tables`
			inner join `information_schema`.`columns`
				on `columns`.`table_name` = `tables`.`table_name`
			where `tables`.`table_schema` = schema()
		');

		if (empty($columns)) {
			return;
		}
		
		$models = [];
		foreach ($columns as $c) {
			if (!isset($moedls[$c['table_name']])) {
				$moedls[$c['table_name']] = new StdModel(
					$c['table_name'],
					$c['table_comment'],
				);
			}
		}

	}

}