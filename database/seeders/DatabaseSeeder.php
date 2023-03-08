<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\About;
use App\Models\Bank;
use App\Models\Level;
use App\Models\Menu;
use App\Models\RegistrationFee;
use App\Models\Section;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Slider;
use App\Models\User;
use Cviebrock\EloquentSluggable\Services\SlugService;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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

        User::factory()->create([
            'name'              => 'Administrator',
            'username'          => 'admin',
            'email'             => 'erfandibagus532@gmail.com',
            'email_verified_at' => now(),
            'password'          => Hash::make('admin'),
            'level_id'          => 1,
            'status'            => true
        ]);

        $routes =  Level::routes()->all();
        Level::create([
            'name'      => 'Administrator',
            'access'    => implode(',', $routes),
            'user_id'   => 1
        ]);

        Level::create([
            'name'      => 'User',
            'access'    => '',
            'user_id'   => 1
        ]);

        Bank::create([
            'name'      => 'Erfandi Bagus',
            'bank_name' => 'BCA',
            'number'    => '3320411725',
            'user_id'   => 1
        ]);

        RegistrationFee::create([
            'name'      => 'Biaya Pendaftaran',
            'fee'       => 50000,
            'user_id'   => 1
        ]);

        Service::create([
            'name'          => 'Sertifikasi',
            'service_code'  => 'SER',
            'user_id'       => 1
        ]);

        Setting::create([
            'name'          => 'Sakti Indonesia'
        ]);

        Slider::create([
            'name'          => 'Slider 1'
        ]);

        Menu::create([
            'name'          => 'Beranda',
            'link'          => '/',
            'sort'          => '1'
        ]);

        Section::create([
            'name'      => 'Slider',
            'slug'      => SlugService::createSlug(Section::class, 'slug', 'Sliders'),
            'status'    => false
        ]);
        Section::create([
            'name'      => 'Tentang Kami',
            'slug'      => SlugService::createSlug(Section::class, 'slug', 'About'),
            'status'    => false
        ]);
        Section::create([
            'name'      => 'Link Terkait',
            'slug'      => SlugService::createSlug(Section::class, 'slug', 'Links'),
            'status'    => false
        ]);
        Section::create([
            'name'      => 'Layanan Kami',
            'slug'      => SlugService::createSlug(Section::class, 'slug', 'Services'),
            'status'    => false
        ]);
        Section::create([
            'name'      => 'Testimonial',
            'slug'      => SlugService::createSlug(Section::class, 'slug', 'Testimonials'),
            'status'    => false
        ]);
        Section::create([
            'name'      => 'Call to Action',
            'slug'      => SlugService::createSlug(Section::class, 'slug', 'Call to Action'),
            'status'    => false
        ]);
        Section::create([
            'name'      => 'Berita Terbaru',
            'slug'      => SlugService::createSlug(Section::class, 'slug', 'Posts'),
            'status'    => false
        ]);

        About::create([
            'name' => 'Tentang Kami'
        ]);
    }
}
