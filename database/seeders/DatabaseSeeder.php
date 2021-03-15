<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Company;
use App\Models\Set;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */

    public function run()
    {
        $companyNames = [
            'ГалСен' => 'https://galsen.pro/',
            'Учтех-Профи' => 'http://labstand.ru/',
            'Лабсис' => 'https://labsys.ru/',
            'Зарница' => 'https://zarnitza.ru/',
            'ЭнергияЛаб' => 'https://www.vrnlab.ru/',
            'Новатор Лаб' => 'https://new.novatorlab.ru/ru/',
            'Центр' => 'https://ntpcentr.com',
            'Measlab' => 'https://measlab.ru',
            'Дидактические Системы' => 'https://disys.ru',
            'УМЦ СПбГУТ' => 'https://cemsut.ru',
            'Алтис' => 'https://altis.su',
            'Квазар' => 'https://kvazar-ufa.com/laboratornye-stendy.html'
        ];
        foreach ($companyNames as $companyName => $url) {

            $companyId = Company::factory()
                ->create([
                    'title' => $companyName,
                    'slug' => Str::slug($companyName),
                    'url' => $url
                ])
                ->id;

            $categoryIds = Category::factory()
                ->count(1)
                ->create(['company_id' => $companyId, 'parent_id' => null])
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
                        ->count(10)
                        ->create(['category_id' => $nestedCategoryId]);
                }
            }
        }
    }
}

