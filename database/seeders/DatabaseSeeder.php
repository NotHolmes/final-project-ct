<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
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
        print('Seeding user01@api.example.com'."\n");
        $user = new User();
        $user->name = "user01";
        $user->role = 'USER';
        $user->email = 'user01@api.example.com';
        $user->password = bcrypt('userpass');
        $user->save();

        $admin = new User();
        $admin->name = "admin01";
        $admin->role = 'ADMIN';
        $admin->email = 'admin01@example.com';
        $admin->password = bcrypt('adminpass');
        $admin->save();

        $user = new User();
        $user->name = "user02";
        $user->email = 'user02@api.example.com';
        $user->password = bcrypt('userpass');
        $user->point = 150;
        $user->save();

        $user = new User();
        $user->name = "user03";
        $user->email = "user03@api.example.com";
        $user->password = bcrypt('userpass');
        $user->point = 250;
        $user->save();

        $user = new User();
        $user->name = "user04";
        $user->email = "user04@api.example.com";
        $user->password = bcrypt('userpass');
        $user->point = 450;
        $user->save();

        $user = new User();
        $user->name = "Black Adam";
        $user->email = 'black_adam@api.example.com';
        $user->password = bcrypt('blackadam');
        $user->point = 1500;
        $user->save();

        $this->call(CategorySeeder::class);
        $this->call(PostSeeder::class);

        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
