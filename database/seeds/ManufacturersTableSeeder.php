<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;


class ManufacturersTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		//
		DB::table( 'manufactures' )->insert( [
				[
					'title' => 'ЛГВ Капсуль',
					'alias' => 'lgv-kapsul',
				],

				[
					'title' => 'Гарден Стейт Нутритионалс, США',
					'alias' => '"garden-stejt-nutritionals-ssha',
				],
				[
					'title' => 'Польфарма С.А.,Фармацевтический завод, Польша',
					'alias' => 'polfarma-s-a-farmatsevticheskij-zavod-polsha',
				]

			]
		);
	}
}
