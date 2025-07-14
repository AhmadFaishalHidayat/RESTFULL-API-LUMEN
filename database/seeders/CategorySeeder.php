<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $categories = [
            'Programming',
            'Web Development',
            'API Development',
            'Database Management',
            'Software Engineering',
            'DevOps',
            'Cloud Computing',
            'Mobile Development',
            'Data Science',
            'Machine Learning',
            'Cybersecurity',
            'Game Development',
            'UI/UX Design',
            'Project Management',
            'Agile Methodologies',
        ];

        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }

        $this->command->info(count($categories) . ' Categories seeded successfully.');
    }
}
