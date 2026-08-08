<?php
require __DIR__ . '/../vendor/autoload.php';
$app = require_once __DIR__ . '/../bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\Course;

$course = Course::first();

$requestArray = [
    'masterclass_settings' => [
        'eyebrow_title' => 'নতুন আপডেট টেস্ট ' . rand(100, 999),
        'zoom_title' => 'Zoom লাইভ ' . rand(100, 999),
    ]
];

$mc = $requestArray['masterclass_settings'];
$existing = is_array($course->masterclass_settings) ? $course->masterclass_settings : [];
$requestArray['masterclass_settings'] = array_merge($existing, $mc);

$course->update($requestArray);

$updated = Course::find($course->id);
echo "Result after update(): " . json_encode($updated->masterclass_settings) . "\n";
