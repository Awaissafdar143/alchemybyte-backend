<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Blog::insert([
            [
                'title' => 'Introduction to Laravel',
                'description' => 'A beginner-friendly guide to Laravel framework.',
                'keyword' => 'Laravel, PHP, Web Development',
                'slug' => 'introduction-to-laravel',
                'image' => 'blogs/laravel.png',
                'content' => 'Laravel is a PHP framework that makes web development easier...',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Mastering Filament Admin Panel',
                'description' => 'Learn how to use Filament to create powerful admin dashboards.',
                'keyword' => 'Filament, Laravel, Dashboard',
                'slug' => 'mastering-filament-admin-panel',
                'image' => 'blogs/filament.png',
                'content' => 'Filament is an admin panel for Laravel applications...',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'SEO Optimization Tips',
                'description' => 'Boost your website’s ranking with these SEO techniques.',
                'keyword' => 'SEO, Optimization, Google Ranking',
                'slug' => 'seo-optimization-tips',
                'image' => 'blogs/seo.png',
                'content' => 'SEO is crucial for any website to get organic traffic...',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
