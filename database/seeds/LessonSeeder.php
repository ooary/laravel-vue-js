<?php

use Illuminate\Database\Seeder;

class LessonSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
         $faker = Faker\Factory::create();

        $limit = 100;

        for ($i = 0; $i < $limit; $i++) {
            DB::table('lessons')->insert([ //,
                'lesson_name' => $faker->name,
                
            ]);
        }
        $this->command->info('seed sukses gan!');
    }
}
