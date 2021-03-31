<?php

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
        factory(App\Article::class, 5)->create();
        factory(App\Category::class, 5)->create();
        factory(App\Comment::class, 5)->create();

        factory(App\User::class)->create([
            "name" => "Admin",
            "email" => "admin@gmail.com",
        ]);
        factory(App\Role::class)->create([
            "name" => "Admin",
        ]);

        factory(App\Role::class)->create([
            "name" => "Member",
            "label" => "Author",

        ]);

        factory(App\Role::class)->create([
            "name" => "User",

        ]);

        factory(App\Ability::class)->create([
            "name" => "crud_account",

        ]);

        factory(App\Ability::class)->create([
            "name" => "Ban_User",

        ]);

        factory(App\Ability::class)->create([
            "name" => "Post_Content",

        ]);

    }
}
