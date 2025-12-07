<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Page;
use App\Models\Section;
use App\Models\Program;
use App\Models\Event;
use App\Models\BlogPost;
use App\Models\Testimonial;
use App\Models\GalleryAlbum;
use App\Models\Setting;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@sunrays.com',
            'password' => bcrypt('password'),
        ]);

        // Create Home Page with Sections
        $homePage = Page::create([
            'title' => 'Welcome to Sunrays Preschool',
            'slug' => 'home',
            'meta_description' => 'Sunrays Preschool - Nurturing young minds with care and excellence',
            'is_published' => true,
        ]);

        Section::create([
            'page_id' => $homePage->id,
            'type' => 'hero',
            'sort_order' => 1,
            'content' => [
                'title' => 'Welcome to Sunrays Preschool',
                'subtitle' => 'Where Learning Meets Fun and Every Child Shines Bright',
                'buttonText' => 'Explore Our Programs',
                'buttonLink' => '/programs',
                'image' => ''
            ]
        ]);

        Section::create([
            'page_id' => $homePage->id,
            'type' => 'features',
            'sort_order' => 2,
            'content' => [
                'items' => [
                    ['title' => 'Expert Teachers', 'description' => 'Qualified and caring educators dedicated to your child\'s growth'],
                    ['title' => 'Safe Environment', 'description' => 'Secure, clean, and child-friendly facilities'],
                    ['title' => 'Creative Learning', 'description' => 'Hands-on activities that spark imagination and curiosity'],
                    ['title' => 'Individual Attention', 'description' => 'Small class sizes ensure personalized care'],
                    ['title' => 'Holistic Development', 'description' => 'Focus on cognitive, social, and emotional growth'],
                    ['title' => 'Parent Partnership', 'description' => 'Regular communication and involvement opportunities']
                ]
            ]
        ]);

        Section::create([
            'page_id' => $homePage->id,
            'type' => 'program_list',
            'sort_order' => 3,
            'content' => ['title' => 'Our Programs', 'limit' => 3]
        ]);

        Section::create([
            'page_id' => $homePage->id,
            'type' => 'testimonials',
            'sort_order' => 4,
            'content' => ['title' => 'What Parents Say']
        ]);

        Section::create([
            'page_id' => $homePage->id,
            'type' => 'contact_form',
            'sort_order' => 5,
            'content' => ['title' => 'Get in Touch']
        ]);

        // Create About Page
        $aboutPage = Page::create([
            'title' => 'About Us',
            'slug' => 'about-us',
            'meta_description' => 'Learn about Sunrays Preschool - our mission, values, and commitment to early childhood education',
            'is_published' => true,
        ]);

        Section::create([
            'page_id' => $aboutPage->id,
            'type' => 'hero',
            'sort_order' => 1,
            'content' => [
                'title' => 'About Sunrays Preschool',
                'subtitle' => 'Building Foundations for Lifelong Learning',
                'buttonText' => '',
                'buttonLink' => '',
                'image' => ''
            ]
        ]);

        Section::create([
            'page_id' => $aboutPage->id,
            'type' => 'text',
            'sort_order' => 2,
            'content' => [
                'html' => '<h2>Our Mission</h2><p>At Sunrays Preschool, we believe that every child is unique and deserves a nurturing environment where they can explore, learn, and grow. Our mission is to provide high-quality early childhood education that fosters creativity, critical thinking, and a love for learning.</p><h2>Our Approach</h2><p>We follow a play-based learning approach that combines structured activities with free exploration. Our curriculum is designed to develop the whole child - intellectually, socially, emotionally, and physically.</p><h2>Our Facilities</h2><p>Our modern, purpose-built facility features bright, spacious classrooms, a secure outdoor play area, and specialized learning zones for art, music, and reading.</p>'
            ]
        ]);

        // Create Programs
        Program::create([
            'title' => 'Playgroup (18 months - 2.5 years)',
            'slug' => 'playgroup',
            'age_group' => '18 months - 2.5 years',
            'timing' => '9:00 AM - 11:30 AM',
            'short_description' => 'A gentle introduction to preschool for our youngest learners',
            'description' => 'Our Playgroup program provides a warm, nurturing environment where toddlers can begin their educational journey. Through sensory play, music, art, and movement activities, children develop fine and gross motor skills, language abilities, and social awareness. Our experienced teachers create a safe space for exploration and discovery.',
            'fee' => '350',
            'cover_image' => ''
        ]);

        Program::create([
            'title' => 'Nursery (2.5 - 3.5 years)',
            'slug' => 'nursery',
            'age_group' => '2.5 - 3.5 years',
            'timing' => '9:00 AM - 12:00 PM',
            'short_description' => 'Building confidence and independence through structured play',
            'description' => 'The Nursery program focuses on developing independence, social skills, and early literacy. Children engage in circle time, storytelling, creative arts, and outdoor play. We introduce basic concepts of numbers, letters, shapes, and colors through fun, hands-on activities that keep young minds engaged and excited about learning.',
            'fee' => '400',
            'cover_image' => ''
        ]);

        Program::create([
            'title' => 'Junior Kindergarten (3.5 - 4.5 years)',
            'slug' => 'junior-kg',
            'age_group' => '3.5 - 4.5 years',
            'timing' => '9:00 AM - 1:00 PM',
            'short_description' => 'Preparing for formal learning with a focus on foundational skills',
            'description' => 'Junior KG introduces more structured learning while maintaining a play-based approach. Children work on pre-reading and pre-math skills, develop writing readiness, and engage in science exploration and creative projects. Our program emphasizes problem-solving, critical thinking, and collaboration.',
            'fee' => '450',
            'cover_image' => ''
        ]);

        Program::create([
            'title' => 'Senior Kindergarten (4.5 - 5.5 years)',
            'slug' => 'senior-kg',
            'age_group' => '4.5 - 5.5 years',
            'timing' => '9:00 AM - 2:00 PM',
            'short_description' => 'Comprehensive preparation for primary school success',
            'description' => 'Our Senior KG program provides comprehensive school readiness. Children develop strong literacy and numeracy foundations, enhance their communication skills, and build confidence in their abilities. The curriculum includes phonics, early reading, basic math concepts, science experiments, and creative expression through art, music, and drama.',
            'fee' => '500',
            'cover_image' => ''
        ]);

        // Create Events
        Event::create([
            'title' => 'Annual Sports Day',
            'slug' => 'sports-day-2025',
            'start_time' => now()->addDays(15)->setTime(9, 0),
            'end_time' => now()->addDays(15)->setTime(13, 0),
            'location' => 'School Playground',
            'description' => 'Join us for our exciting Annual Sports Day! Children will participate in fun races, team games, and activities designed for different age groups. Parents are welcome to cheer on their little champions. Refreshments will be provided.',
            'cover_image' => '',
            'is_published' => true
        ]);

        Event::create([
            'title' => 'Parent-Teacher Meeting',
            'slug' => 'ptm-january-2025',
            'start_time' => now()->addDays(7)->setTime(10, 0),
            'end_time' => now()->addDays(7)->setTime(12, 0),
            'location' => 'Individual Classrooms',
            'description' => 'Our quarterly Parent-Teacher Meeting is an opportunity to discuss your child\'s progress, strengths, and areas for development. Please schedule your 15-minute slot in advance.',
            'cover_image' => '',
            'is_published' => true
        ]);

        Event::create([
            'title' => 'Winter Carnival',
            'slug' => 'winter-carnival',
            'start_time' => now()->addDays(30)->setTime(10, 0),
            'end_time' => now()->addDays(30)->setTime(15, 0),
            'location' => 'School Campus',
            'description' => 'Celebrate the season with our Winter Carnival! Enjoy games, face painting, craft stations, a magic show, and delicious food stalls. This family-friendly event is open to all current and prospective families.',
            'cover_image' => '',
            'is_published' => true
        ]);

        // Create Blog Posts
        BlogPost::create([
            'title' => 'The Importance of Play-Based Learning',
            'slug' => 'play-based-learning',
            'excerpt' => 'Discover why play is the foundation of early childhood education and how it benefits your child\'s development.',
            'content' => '<p>Play is not just fun - it\'s how young children learn best. Through play, children develop critical thinking skills, creativity, social abilities, and emotional regulation.</p><p>At Sunrays, we integrate play into every aspect of our curriculum. Whether building with blocks, engaging in pretend play, or exploring nature, children are constantly learning and growing.</p><p>Research shows that play-based learning leads to better outcomes in literacy, numeracy, and social-emotional development compared to traditional didactic methods.</p>',
            'author' => 'Principal Sarah Johnson',
            'published_at' => now()->subDays(5),
            'cover_image' => ''
        ]);

        BlogPost::create([
            'title' => '5 Tips for a Smooth Preschool Transition',
            'slug' => 'preschool-transition-tips',
            'excerpt' => 'Starting preschool is a big step. Here are our top tips to help your child adjust smoothly.',
            'content' => '<h3>1. Visit the School Together</h3><p>Familiarize your child with the new environment before the first day.</p><h3>2. Establish a Routine</h3><p>Start practicing the morning routine a few weeks in advance.</p><h3>3. Read Books About School</h3><p>Stories can help children understand what to expect.</p><h3>4. Stay Positive</h3><p>Your attitude influences your child\'s feelings about school.</p><h3>5. Keep Goodbyes Short</h3><p>A quick, confident goodbye helps children settle faster.</p>',
            'author' => 'Teacher Emily Chen',
            'published_at' => now()->subDays(12),
            'cover_image' => ''
        ]);

        // Create Testimonials
        Testimonial::create([
            'parent_name' => 'Priya Sharma',
            'student_name' => 'Aarav',
            'content' => 'Sunrays has been wonderful for our son! The teachers are caring and professional, and we\'ve seen tremendous growth in his confidence and social skills. Highly recommend!',
            'rating' => 5,
            'is_approved' => true
        ]);

        Testimonial::create([
            'parent_name' => 'Michael Johnson',
            'student_name' => 'Emma',
            'content' => 'We couldn\'t be happier with our choice. Emma loves going to school every day, and the curriculum is perfectly balanced between learning and play. The communication from teachers is excellent.',
            'rating' => 5,
            'is_approved' => true
        ]);

        Testimonial::create([
            'parent_name' => 'Anjali Patel',
            'student_name' => 'Rohan',
            'content' => 'The individual attention each child receives is remarkable. Rohan has blossomed here, and we appreciate how the school involves parents in the learning journey.',
            'rating' => 5,
            'is_approved' => true
        ]);

        // Create Gallery Album
        GalleryAlbum::create([
            'title' => 'Classroom Activities',
            'description' => 'A glimpse into our daily learning adventures',
            'cover_image' => '',
            'is_published' => true
        ]);

        // Create Settings
        Setting::create(['key' => 'site_name', 'value' => 'Sunrays Preschool', 'group' => 'general']);
        Setting::create(['key' => 'contact_email', 'value' => 'info@sunrays.edu', 'group' => 'contact']);
        Setting::create(['key' => 'contact_phone', 'value' => '+1 (555) 123-4567', 'group' => 'contact']);
        Setting::create(['key' => 'address', 'value' => '123 Sunshine Avenue, Kids City, State 12345', 'group' => 'contact']);
        Setting::create(['key' => 'facebook_url', 'value' => 'https://facebook.com/sunrayspreschool', 'group' => 'social']);
        Setting::create(['key' => 'instagram_url', 'value' => 'https://instagram.com/sunrayspreschool', 'group' => 'social']);
    }
}
