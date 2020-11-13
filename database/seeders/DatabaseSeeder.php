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
    //колхозный но рабочий вариант
    public function run()

    {
        for ($i = 1; $i <= 12; $i++) {
            $companyId = Company::factory()
                ->create()
                ->pluck('id')
                ->toArray();


            $categoryId = Category::factory()
                ->count(2)
                ->create(['company_id' => array_rand(array_flip($companyId))])
                ->pluck('id')
                ->toArray();

            $nestedCategoryId = Category::factory()
                ->count(3)
                ->create(['company_id' => array_rand(array_flip($companyId)), 'parent_id' => array_rand(array_flip($categoryId))])
                ->pluck('id')
                ->toArray();

            Set::factory()
                ->count(4)
                ->create(['company_id' => array_rand(array_flip($companyId)), 'category_id' => array_rand(array_flip($categoryId))]);

            Set::factory()
                ->count(4)
                ->create(['company_id' => array_rand(array_flip($companyId)), 'category_id' => array_rand(array_flip($nestedCategoryId))]);
        }

    }
    //тоже работает
   /* public function run()

    {

        $companyId = Company::factory()
            ->times(12)
            ->create()
            ->pluck('id')
            ->toArray();


        $categoryId = Category::factory()
            ->count(20)
            ->make()

            ->each(function ($category) use ($companyId) {
                $category->company_id = array_rand(array_flip($companyId));
                $category->save();
            })
            ->pluck('id')
            ->toArray();

        $nestedCategoryId = Category::factory()

            ->count(40)
            ->make()
            ->each(function ($category) use ($companyId, $categoryId) {

                $category->company_id = array_rand(array_flip($companyId));
                $category->parent_id = array_rand(array_flip($categoryId));

                $category->save();
          })
            ->pluck('id')
            ->toArray();

        Set::factory()
            ->count(40)
            ->make()
            ->each(function ($set) use ($companyId, $categoryId) {
                $set->company_id = array_rand(array_flip($companyId));
                $set->category_id = array_rand(array_flip($categoryId));
                $set->save();
            });

        Set::factory()
            ->count(56)
            ->make()
            ->each(function ($set) use ($companyId, $nestedCategoryId) {
                $set->company_id = array_rand(array_flip($companyId));
                $set->category_id = array_rand(array_flip($nestedCategoryId));
                $set->save();
            });


    }*/
}
//
//->pluck('id');

// $this->call(SetSeeder::class);
// $companyIds = Company::factory()->times(20)->create()->toArray();
// $categoryIds = Category::factory()->times(2)->forCompany(['id' => array_rand($companyIds)])->create()->pluck('id')->toArray();
//Set::factory()->times(80)->forCompany(['company_id' => anyIds)])
// \App\Models\User::factory(10)->create();


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
