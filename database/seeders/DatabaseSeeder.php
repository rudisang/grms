<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        
        \App\Models\User::factory(1)->create();

        \App\Models\Role::factory()->count(3)
        ->state(new Sequence(
            ['role' => 'Graduate'],
            ['role' => 'Company'],
            ['role' => 'Admin'],
        ))
        ->create();

        \App\Models\Category::factory()->count(11)
        ->state(new Sequence(
            ['name' => 'Accounting'],
            ['name' => 'Finance'],
            ['name' => 'Programming'],
            ['name' => 'Computer Science'],
            ['name' => 'Information Technology'],
            ['name' => 'Sales'],
            ['name' => 'Marketing'],
            ['name' => 'Tourism'],
            ['name' => 'Hospitality'],
            ['name' => 'Health'],
            ['name' => 'Freelance'],
        ))
        ->create();

        \App\Models\Status::factory()->count(4)
        ->state(new Sequence(
            ['status' => 'Pending'],
            ['status' => 'Approved'],
            ['status' => 'Rejected'],
            ['status' => 'Suspended'],
        ))
        ->create();
  
    }
}
