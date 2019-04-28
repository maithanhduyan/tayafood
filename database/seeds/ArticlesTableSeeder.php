<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\App;

class ArticlesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Article::class,30)->create();
    }
}
