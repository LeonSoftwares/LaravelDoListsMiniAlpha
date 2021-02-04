<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Illuminate\Database\Eloquent\Model;

use DB;
use Carbon\Carbon;

class DoListsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('do_lists')->insert([
        	[
        		'name' => 'Создание сайта',
        		'do' => 'Создание сайта с bootstrap',
        		'status' => 'В работе',
        		'order_item' => '1',
        		'user_id'	=> '1',
        		'created_at' => Carbon::now(),
        	],
        	[
        		'name' => 'Починить БД',
        		'do' => 'Починить бд магазина',
        		'status' => 'Выполнил',
        		'order_item' => '2',
        		'user_id'	=> '1',
        		'created_at' => Carbon::now(),
        	],
        	[
        		'name' => 'Drag & Drop',
        		'do' => 'Перетаскивание элементов дел',
        		'status' => 'В работе',
        		'order_item' => '3',
        		'user_id'	=> '1',
        		'created_at' => Carbon::now(),
        	],
        	[
        		'name' => 'Верстка сайта',
        		'do' => 'Адаптировать верстку сайта',
        		'status' => 'В работе',
        		'order_item' => '4',
        		'user_id'	=> '1',
        		'created_at' => Carbon::now(),
        	],
        	[
        		'name' => 'Рефакторинг контроллеров',
        		'do' => 'Сделать рефакторинг контроллеров Laravel',
        		'status' => 'В работе',
        		'order_item' => '5',
        		'user_id'	=> '1',
        		'created_at' => Carbon::now(),
        	],
        	[
        		'name' => 'Создать импорт записей',
        		'do' => 'Импорт пользователей в бд',
        		'status' => 'В работе',
        		'order_item' => '6',
        		'user_id'	=> '2',
        		'created_at' => Carbon::now(),
        	],
        	[
        		'name' => 'Создать экспорт записей',
        		'do' => 'Экспорт пользователей в бд',
        		'status' => 'В работе',
        		'order_item' => '7',
        		'user_id'	=> '2',
        		'created_at' => Carbon::now(),
        	],
        ]);
    }
}
