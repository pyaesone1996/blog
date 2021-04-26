<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        factory(App\Article::class, 5)->create();
        factory(App\Category::class, 2)->create();
        factory(App\Comment::class, 5)->create();

        factory(App\User::class)->create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
        ]);

        factory(App\Role::class)->create([
            'name' => 'Admin',
            'label' => 'Admin',
        ]);

        factory(App\Role::class)->create([
            'name' => 'Member',
            'label' => 'Member',
        ]);

        factory(App\Role::class)->create([
            'name' => 'User',
            'label' => 'User',
        ]);

        factory(App\Settings::class)->create([
            'site_title' => 'Laravel',
            'site_logo' => '1618584170logo-icon.png',
            'site_icon' => '1618584170logo-icon.png',
            'site_tagline' => 'Online Writer Platform',
            'site_description' => 'Lorem ipsum dolor sit, amet consectetur adipisicing elit. Quis cum veritatis similique ipsam nesciunt eaque libero. Ad itaque,(SEO FOR META KEYWORD)',
            'email' => 'pyaesone.march28@gmail.com',
            'facebook' => 'https://www.facebook.com',
            'youtube' => 'https://www.youtube.com',
            'twitter' => 'https://www.twitter.com',
            'footer_information' => '© 2020 All Right Reserved , Power By The Calm Tech',
        ]);

        DB::table('role_user')
        ->leftJoin('users', 'id', 'role_user.user_id')
        ->where('email', 'admin@gmail.com')->insert([
            'user_id' => 6,
            'role_id' => 1,
        ]);

        foreach (range(1, 5) as $index) {
            DB::table('role_user')
        ->leftJoin('users', 'id', 'role_user.user_id')
        ->where('email', '!=', 'admin@gmail.com')->insert([
            'user_id' => $index,
            'role_id' => 2,
        ]);
        }
    }
}
