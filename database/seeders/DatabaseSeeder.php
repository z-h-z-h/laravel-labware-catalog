<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Company;
use App\Models\Set;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Company::factory()
            ->times(20)
            ->hasCategories(2)
            ->hasSets(4)
            ->create();

        // $this->call(SetSeeder::class);
        // $companyIds = Company::factory()->times(20)->create()->toArray();
        // $categoryIds = Category::factory()->times(2)->forCompany(['id' => array_rand($companyIds)])->create()->pluck('id')->toArray();
        //Set::factory()->times(80)->forCompany(['company_id' => anyIds)])
        // \App\Models\User::factory(10)->create();
    }
}
/*class DatabaseSeeder extends Seeder
{
    public function run()
    {
        $userIds = factory(App\User::class, 3)->create()->pluck('id')->toArray();
        $categoryIds = factory(App\Category::class, 5)->create()->pluck('id')->toArray();

        $posts = factory(App\Post::class, 25)->make()->each(function($post) use ($userIds, $categoryIds) {
            $post->user_id = array_random($userIds);
            $post->category_id = array_random($categoryIds);
            // $post->save();
        })->toArray();

        App\Post::insert($posts);
    }
}*/
