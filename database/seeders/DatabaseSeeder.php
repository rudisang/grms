<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Hash;

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

        $password = "12345678";

        \App\Models\User::factory(1)->create([
            'name' => "Tshepo",
            'surname' => "Phuthego",
            'gender' => 'Male',
            'age' => '1998-07-21',
            'role_id' => 2,
            'mobile' => 76123456,
            'email' => 'tshepo@grms.com',
            'password' => Hash::make($password), 
            ]);

            \App\Models\User::factory(1)->create([
                'name' => "Tshepo",
                'surname' => "Phuthego",
                'gender' => 'Male',
                'age' => '1998-07-21',
                'role_id' => 1,
                'mobile' => 76123456,
                'email' => 'phuthego@grms.com',
                'password' => Hash::make($password), 
                ]);

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

        \App\Models\Company::factory(1)->create([
            'name' => 'Ditebogo ICT',
            'physical_address' => '103 Northring rd, Gaborone',
            'postal_address' => 'PO BOX 23 Gaborone',
            'email' => 'info@dict.co.bw',
            'phone' => 3914168,
            'cover' => 'no_cover.jpg',
            'logo' => 'no_logo.png',
            'verified' => 1,
            'bio' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Tenetur atque consequuntur aliquid! Aspernatur officiis consequatur, porro maiores iure eaque animi doloremque suscipit, rerum minima labore numquam cupiditate dolor, aliquam magnam.
            Ex dolorem laboriosam ad nulla natus magnam ipsa reiciendis et soluta, aut ipsam in eos, dolor ducimus sint, id libero animi mollitia totam exercitationem non doloribus at veniam quos! Facere.
            Commodi, doloremque! Nobis tempora laborum amet, vero eius quam ipsam eos asperiores natus animi beatae optio eveniet earum perspiciatis at dolorem necessitatibus consequatur soluta, unde, labore aperiam libero praesentium cum!',
            'user_id' => 2
            ]);

            \App\Models\JobPost::factory(1)->create([
                'company_id' => 1,
                'title'  => 'Programmer Wanted',
                'category_id'  => 3,
                'position' => 'Full Time',
                'details' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Tenetur atque consequuntur aliquid! Aspernatur officiis consequatur, porro maiores iure eaque animi doloremque suscipit, rerum minima labore numquam cupiditate dolor, aliquam magnam.
                Ex dolorem laboriosam ad nulla natus magnam ipsa reiciendis et soluta,',
                'deadline' => '2021-05-10',
                ]);

                \App\Models\JobPost::factory(1)->create([
                    'company_id' => 1,
                    'title'  => 'Laravel Programmer Wanted',
                    'category_id'  => 3,
                    'position' => 'Full Time',
                    'details' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Tenetur atque consequuntur aliquid! Aspernatur officiis consequatur, porro maiores iure eaque animi doloremque suscipit, rerum minima labore numquam cupiditate dolor, aliquam magnam.
                    Ex dolorem laboriosam ad nulla natus magnam ipsa reiciendis et soluta,',
                    'deadline' => '2021-05-10',
                    ]);

                    \App\Models\JobPost::factory(1)->create([
                        'company_id' => 1,
                        'title'  => 'Accounted Needed',
                        'category_id'  => 1,
                        'position' => 'Full Time',
                        'details' => 'Lorem, ipsum dolor sit amet consectetur adipisicing elit. Tenetur atque consequuntur aliquid! Aspernatur officiis consequatur, porro maiores iure eaque animi doloremque suscipit, rerum minima labore numquam cupiditate dolor, aliquam magnam.
                        Ex dolorem laboriosam ad nulla natus magnam ipsa reiciendis et soluta,',
                        'deadline' => '2021-05-10',
                        ]);

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
