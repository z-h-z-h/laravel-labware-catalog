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
                ->id;


            $categoryIds = Category::factory()
                ->count(1)
                ->create(['company_id' => $companyId])
                ->pluck('id')
                ->toArray();

            foreach ($categoryIds as $categoryId) {
                $nestedCategoryIds = Category::factory()
                    ->count(4)
                    ->create(['company_id' => $companyId, 'parent_id' => $categoryId])
                    ->pluck('id')
                    ->toArray();
                foreach ($nestedCategoryIds as $nestedCategoryId) {
                    Set::factory()
                        ->count(3)
                        ->create(['category_id' => $nestedCategoryId]);
                }
            }


        }


    }
}

