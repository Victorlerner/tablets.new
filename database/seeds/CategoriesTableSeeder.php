<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		//

		DB::table( 'categories' )->insert( [
				[
					'title' => 'Антибиотики',
					'alias' => 'antibiotiki',
					'parent_id' => 0,
				],
				[
					'title' => 'Сульфаниламидные',
					'alias' => 'sulfanilamidnye',
					'parent_id' => 1,
				],
				[
					'title' => 'Витамины',
					'alias' => 'vitaminy',
					'parent_id' => 0,
				],
				[
					'title' => 'Витамин С',
					'alias' => 'vitamin-s',
					'parent_id' => 3,
				],
				[
					'title' => 'Витамины группы В',
					'alias' => 'vitaminy-gruppy-v',
					'parent_id' => 3,
				],
				[
					'title' => 'Витамины для зрения',
					'alias' => 'vitaminy-dlya-zreniya',
					'parent_id' => 3,
				]

			]

		);
	}
}
