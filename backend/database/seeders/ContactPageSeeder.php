<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Page;
use App\Models\Section;

class ContactPageSeeder extends Seeder
{
    public function run(): void
    {
        $page = Page::create([
            'title' => 'Contact Us',
            'slug' => 'contact-us',
            'meta_description' => 'Get in touch with Sunrays Preschool - we would love to hear from you',
            'is_published' => true,
        ]);

        Section::create([
            'page_id' => $page->id,
            'type' => 'hero',
            'sort_order' => 1,
            'content' => [
                'title' => 'Contact Us',
                'subtitle' => 'We would love to hear from you',
                'buttonText' => '',
                'buttonLink' => '',
                'image' => ''
            ]
        ]);

        Section::create([
            'page_id' => $page->id,
            'type' => 'text',
            'sort_order' => 2,
            'content' => [
                'html' => '<div class="grid grid-cols-1 md:grid-cols-2 gap-8"><div><h3>Visit Us</h3><p>123 Sunshine Avenue<br>Kids City, State 12345</p></div><div><h3>Call Us</h3><p>Phone: +1 (555) 123-4567<br>Email: info@sunrays.edu</p></div></div>'
            ]
        ]);

        Section::create([
            'page_id' => $page->id,
            'type' => 'contact_form',
            'sort_order' => 3,
            'content' => ['title' => 'Send us a Message']
        ]);
    }
}
