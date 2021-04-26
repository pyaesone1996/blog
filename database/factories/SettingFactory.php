<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Settings;
use Faker\Generator as Faker;

$factory->define(Settings::class, function (Faker $faker) {
    return [
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
    ];
});
