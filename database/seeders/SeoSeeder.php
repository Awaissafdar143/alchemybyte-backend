<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Seo; // Adjust if your model name is different
use Illuminate\Support\Facades\DB;

class SeoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('metas')->insert([
            [
                'page_name'   => 'Home',
                'Title'       => 'Home - IT Solutions | Alchemy Byte',
                'description' => 'At Alchemy Byte, we transform your visionary ideas into impactful digital solutions. Our team of experts is committed to revolutionizing your business through advanced technology, ensuring you stay ahead in a competitive landscape.',
                'keyword'     => 'Home - Alchemy Byte',
                'OgImage'     => 'storage/01JMWZK893MB1HHDDFBXG1GRK4.jpg',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'page_name'   => 'Blog',
                'Title'       => 'Blog - IT Solutions | Alchemy Byte',
                'description' => 'Propel Your Business with Innovative Idea',
                'keyword'     => 'Blog - Alchemy Byte',
                'OgImage'     => 'storage/01JMWZK893MB1HHDDFBXG1GRK4.jpg',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'page_name'   => 'About',
                'Title'       => 'About - IT Solutions | Alchemy Byte',
                'description' => 'Propel Your Business with Innovative Idea',
                'keyword'     => 'About - Alchemy Byte',
                'OgImage'     => 'storage/01JMWZK893MB1HHDDFBXG1GRK4.jpg',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'page_name'   => 'Service',
                'Title'       => 'Service - IT Solutions | Alchemy Byte',
                'description' => 'Propel Your Business with Innovative Idea',
                'keyword'     => 'Service - Alchemy Byte',
                'OgImage'     => 'storage/01JMWZK893MB1HHDDFBXG1GRK4.jpg',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'page_name'   => 'Project',
                'Title'       => 'Project - IT Solutions | Alchemy Byte',
                'description' => 'Propel Your Business with Innovative Idea',
                'keyword'     => 'Project - Alchemy Byte',
                'OgImage'     => 'storage/01JMWZK893MB1HHDDFBXG1GRK4.jpg',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'page_name'   => 'Case Study',
                'Title'       => 'Case Study - IT Solutions | Alchemy Byte',
                'description' => 'Propel Your Business with Innovative Idea',
                'keyword'     => 'Case Study - Alchemy Byte',
                'OgImage'     => 'storage/01JMWZK893MB1HHDDFBXG1GRK4.jpg',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'page_name'   => 'Testimonials',
                'Title'       => 'Testimonials - IT Solutions | Alchemy Byte',
                'description' => 'Propel Your Business with Innovative Idea',
                'keyword'     => 'Testimonials - Alchemy Byte',
                'OgImage'     => 'storage/01JMWZK893MB1HHDDFBXG1GRK4.jpg',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
            [
                'page_name'   => 'Contact Us',
                'Title'       => 'Contact Us - IT Solutions | Alchemy Byte',
                'description' => 'Propel Your Business with Innovative Idea',
                'keyword'     => 'Contact Us - Alchemy Byte',
                'OgImage'     => 'storage/01JMWZK893MB1HHDDFBXG1GRK4.jpg',
                'created_at'  => now(),
                'updated_at'  => now(),
            ],
        ]);
    }
}
