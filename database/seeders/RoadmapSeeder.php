<?php

namespace Database\Seeders;

use App\Models\Roadmap;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoadmapSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Roadmap::create(["title"=>"Web Development Essentials","description"=>"Learn the fundamental concepts and technologies required for web development, including HTML, CSS, and JavaScript"]);
        Roadmap::create(["title"=>"Frontend Course","description"=>"Explore advanced frontend development techniques, frameworks, and libraries such as React, Vue.js, and Angular."]);
        Roadmap::create(["title"=>"Backend Course","description"=>"Focus on backend development, learning server-side programming languages, databases, API development, and security"]);
        Roadmap::create(["title"=>"Full Stack Diploma","description"=>"Become a full stack developer by mastering both frontend and backend technologies. Learn how to build complete web applications"]);
        Roadmap::create(["title"=>"Graphic Design","description"=>"Develop your skills in graphic design, including principles of design, typography, color theory, and popular design software"]);
        Roadmap::create(["title"=>"UI/UX","description"=>"Learn user interface (UI) and user experience (UX) design principles to create intuitive and visually appealing digital experiences"]);
        Roadmap::create(["title"=>"Essentials of Python.AI","description"=>"Discover the essentials of Python programming language and explore its applications in artificial intelligence and data analysis"]);
        Roadmap::create(["title"=>"Deep and Machine Learning","description"=>"Dive into the field of deep learning and machine learning, understanding algorithms, neural networks, and training models."]);
        Roadmap::create(["title"=>"Data Scientist Diploma","description"=>"Acquire the skills and knowledge needed to become a data scientist, including data analysis, machine learning, and data visualization"]);
        Roadmap::create(["title"=>"Social Media Marketing Essentials","description"=>"Learn the basics of social media marketing, including strategies, content creation, audience targeting, and analytics"]);
        Roadmap::create(["title"=>"Digital Marketing Diploma","description"=>"Master the essentials of digital marketing, including search engine optimization (SEO), paid advertising, email marketing, and analytics"]);
        Roadmap::create(["title"=>"AI","description"=>"Explore the field of artificial intelligence, including machine learning, neural networks, natural language processing, and computer vision."]);

    }
}