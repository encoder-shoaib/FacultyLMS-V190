<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Repositories\CourseRepository;
use App\Models\Course;
use App\Models\Category;
use App\Models\User;

$user = User::first();
auth()->login($user);

$category = Category::first();

$courseRepo = app(CourseRepository::class);

$courseData = [
    'title' => 'Masterclass Full Stack Web Development ' . rand(100, 999),
    'short_description' => 'Comprehensive masterclass course on modern web development with Laravel and React.',
    'description' => '<p>Learn full stack web development step by step in this live interactive masterclass.</p>',
    'category_id' => $category->id,
    'course_type' => 'course',
    'language' => 'en',
    'level_id' => 1,
    'instructor_ids' => [$user->id],
    'is_free' => 0,
    'price' => '1500',
    'is_discountable' => 1,
    'discount_type' => 'flat',
    'discount_amount' => '1000',
    'video_source' => 'youtube',
    'video_link' => 'https://www.youtube.com/watch?v=dQw4w9WgXcQ',
    'status' => 'approved',
    'masterclass_settings' => [
        'eyebrow_title' => 'E-commerce Masterclass Live',
        'class_schedule_title' => '২ দিনব্যাপী E-Commerce Live Masterclass',
        'gold_cta_text' => 'এখনই জয়েন করুন',
        'order_form_title' => 'মাস্টারক্লাসে জয়েন করতে নিচের ফর্মটি পূরণ করুন',
        'benefits_list' => [
            'লাইভ জুম ক্লাসে সরাসরি প্রশ্নোত্তর পর্ব',
            'কোর্স চলাকালীন ১০০% প্র্যাকটিক্যাল গাইডলাইন',
            'রেকর্ডিং ক্লাস এক্সেস ও মেম্বারশিপ পোর্টাল'
        ]
    ]
];

$course = $courseRepo->store($courseData);

echo "SUCCESSFULLY_CREATED_COURSE_ID:" . $course->id . " | SLUG:" . $course->slug;
