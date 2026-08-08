<?php

namespace App\Http\Controllers\Site;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\HomeScreen;
use App\Models\Lesson;
use App\Models\Rating;
use App\Models\Subscriber;
use App\Models\User;
use App\Repositories\BlogRepository;
use App\Repositories\BrandRepository;
use App\Repositories\CategoryRepository;
use App\Repositories\CourseRepository;
use App\Repositories\LessonRepository;
use App\Repositories\LevelRepository;
use App\Repositories\OrganizationRepository;
use App\Repositories\PageRepository;
use App\Repositories\SettingRepository;
use App\Repositories\SubjectRepository;
use App\Repositories\SuccessStoryRepository;
use App\Repositories\TagRepository;
use App\Repositories\TestimonialRepository;
use App\Repositories\UserRepository;
use App\Traits\SendMailTrait;
use Brian2694\Toastr\Facades\Toastr;
use Exception;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    use SendMailTrait;

    public function index(
        UserRepository $userRepository,
        SubjectRepository $subjectRepository,
        LessonRepository $lessonRepository,
        CourseRepository $courseRepository,
        TestimonialRepository $testimonialRepository,
        SuccessStoryRepository $successStoriesRepository,
        CategoryRepository $categoryRepository,
        BlogRepository $blogRepository,
        BrandRepository $brandRepository
    ): View|
    Factory|
    JsonResponse|
    Application {
        try {
            $data = [];
            $websiteMode = setting('website_mode');
            
            if ($websiteMode == 'single_course') {
                $singleCourseId = setting('single_course_id');
                if ($singleCourseId) {
                    $data['course'] = \App\Models\Course::with(['category.language', 'lessons', 'instructor', 'reviews'])
                        ->where('id', $singleCourseId)
                        ->where('status', 'approved')
                        ->first();
                } else {
                    $data['course'] = \App\Models\Course::with(['category.language', 'lessons', 'instructor', 'reviews'])->where('status', 'approved')->first();
                }
            } else {
                $data['course'] = null;
            }
            $data['success_stories'] = $successStoriesRepository->activeStories();

            // dd($data);

            return view('frontend.home', $data);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function home2(
        UserRepository $userRepository,
        SubjectRepository $subjectRepository,
        LessonRepository $lessonRepository,
        CourseRepository $courseRepository,
        TestimonialRepository $testimonialRepository,
        SuccessStoryRepository $successStoriesRepository,
        CategoryRepository $categoryRepository,
        BlogRepository $blogRepository
    ): View|Factory|JsonResponse|Application {
        try {
            $sections             = HomeScreen::where('type', 'home_page')->where('version', 1)->get();

            $instructors          = $subjects = $lessons = $courses = $featured_courses = [];

            $data                 = [
                'sections' => $sections,
            ];

            foreach ($sections as $section) {
                if (arrayCheck('ids', $section->contents)) {
                    if ($section->section == 'instructors') {
                        $instructors         = array_merge($instructors, $section->contents['ids']);
                        $data['instructors'] = $userRepository->findUsers(['role_id' => 2, 'ids' => $instructors], ['instructor']);
                    }
                    if ($section->section == 'subject') {
                        $subjects         = array_merge($subjects, $section->contents['ids']);
                        $data['subjects'] = $subjectRepository->activeSubject(['ids' => $subjects]);
                    }
                    if ($section->section == 'lesson_with_mentor') {
                        $lessons         = array_merge($lessons, $section->contents['ids']);
                        $data['lessons'] = $lessonRepository->activeLesson(['ids' => $lessons]);
                    }
                    if ($section->section == 'single_course') {
                        $courses         = array_merge($courses, $section->contents['ids']);
                        $data['courses'] = $courseRepository->findCourses($courses, ['category.language']);
                    }
                    if ($section->section == 'featured_course') {
                        $featured_courses         = array_merge($featured_courses, $section->contents['ids']);
                        $data['featured_courses'] = $courseRepository->findCourses($featured_courses, ['category.language']);
                    }
                }
                if ($section->section == 'blog_news') {
                    $data['blogs'] = $blogRepository->activeBlogs(['take' => 3]);
                }
                if ($section->section == 'success_story') {
                    $data['success_stories'] = $successStoriesRepository->activeStories();
                }
                if ($section->section == 'top_courses') {
                    $data['top_course_categories'] = $categoryRepository->activeCategories([
                        'take'       => 4,
                        'top_course' => 1,
                        'type'       => 'course',
                    ], ['activeCourses.category.language']);
                }

                if ($section->section == 'counter_section') {
                    $total_rating              = Rating::where('status', 1)->where('commentable_type', Course::class)->sum('rating');
                    $total_students            = User::where('role_id', 3)->where('status', 1)->where('is_deleted', 0)->where('is_user_banned', 0)->count();
                    $data['total_course']      = Course::where('status', 1)->count();
                    $data['total_instructors'] = User::where('role_id', 2)->where('status', 1)->where('is_deleted', 0)->where('is_user_banned', 0)->count();
                    $data['total_students']    = $total_students;
                    $data['total_rating']      = $total_rating;
                    $data['total_satisfies']   = $total_rating / ($total_students * 5) * 100;
                }
            }

            $data['testimonials'] = $testimonialRepository->activeTestimonials();

            return view('frontend.home2', $data);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function home3(
        UserRepository $userRepository,
        SubjectRepository $subjectRepository,
        LessonRepository $lessonRepository,
        CourseRepository $courseRepository,
        TestimonialRepository $testimonialRepository,
        SuccessStoryRepository $successStoriesRepository,
        CategoryRepository $categoryRepository,
        BlogRepository $blogRepository
    ): View|Factory|JsonResponse|Application {
        try {
            $sections             = HomeScreen::where('type', 'home_page')->where('version', 1)->get();

            $instructors          = $subjects = $lessons = $courses = $featured_courses = [];

            $data                 = [
                'sections' => $sections,
            ];

            foreach ($sections as $section) {
                if (arrayCheck('ids', $section->contents)) {
                    if ($section->section == 'instructors') {
                        $instructors         = array_merge($instructors, $section->contents['ids']);
                        $data['instructors'] = $userRepository->findUsers(['role_id' => 2, 'ids' => $instructors], ['instructor']);
                    }
                    if ($section->section == 'subject') {
                        $subjects         = array_merge($subjects, $section->contents['ids']);
                        $data['subjects'] = $subjectRepository->activeSubject(['ids' => $subjects]);
                    }
                    if ($section->section == 'lesson_with_mentor') {
                        $lessons         = array_merge($lessons, $section->contents['ids']);
                        $data['lessons'] = $lessonRepository->activeLesson(['ids' => $lessons]);
                    }
                    if ($section->section == 'single_course') {
                        $courses         = array_merge($courses, $section->contents['ids']);
                        $data['courses'] = $courseRepository->findCourses($courses, ['category.language']);
                    }
                    if ($section->section == 'featured_course') {
                        $featured_courses         = array_merge($featured_courses, $section->contents['ids']);
                        $data['featured_courses'] = $courseRepository->findCourses($featured_courses, ['category.language']);
                    }
                }
                if ($section->section == 'blog_news') {
                    $data['blogs'] = $blogRepository->activeBlogs(['take' => 3]);
                }
                if ($section->section == 'success_story') {
                    $data['success_stories'] = $successStoriesRepository->activeStories();
                }
                if ($section->section == 'top_courses') {
                    $data['top_course_categories'] = $categoryRepository->activeCategories([
                        'take'       => 4,
                        'top_course' => 1,
                        'type'       => 'course',
                    ], ['activeCourses.category.language']);
                }

                if ($section->section == 'counter_section') {
                    $total_rating              = Rating::where('status', 1)->where('commentable_type', Course::class)->sum('rating');
                    $total_students            = User::where('role_id', 3)->where('status', 1)->where('is_deleted', 0)->where('is_user_banned', 0)->count();
                    $data['total_course']      = Course::where('status', 1)->count();
                    $data['total_instructors'] = User::where('role_id', 2)->where('status', 1)->where('is_deleted', 0)->where('is_user_banned', 0)->count();
                    $data['total_students']    = $total_students;
                    $data['total_rating']      = $total_rating;
                    $data['total_satisfies']   = $total_rating / ($total_students * 5) * 100;
                }
            }

            $data['testimonials'] = $testimonialRepository->activeTestimonials();

            return view('frontend.home3', $data);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function subscribe(Request $request): JsonResponse
    {
        $request->validate(
            [
                'email' => ['required', 'string', 'email', 'max:255', 'unique:subscribers'],
            ],
            [
                'email.unique' => __('email_already_subscribed'),
            ]
        );
        if ($request->dont_show_this) {
            session()->put('dont_show', $request->dont_show_this);
        }

        try {
            Subscriber::create($request->all());

            return response()->json(['success' => __('successfully_subscribed')]);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function headerSearch(
        Request $request,
        CourseRepository $courseRepository,
        CategoryRepository $categoryRepository,
        UserRepository $userRepository,
        OrganizationRepository $organizationRepository,
        SubjectRepository $subjectRepository,
        LevelRepository $levelRepository,
        TagRepository $tagRepository
    ): JsonResponse {
        $request->validate([
            'q' => 'required',
        ]);

        try {
            $courses       = $courseRepository->activeCourses([
                'search'   => $request->q,
                'paginate' => 5,
            ]);

            $categories    = $categoryRepository->activeCategories([
                'q'          => $request->q,
                'parent_id'  => 1,
                'take'       => 10,
                'type'       => 'course',
                'top_course' => '1',
            ], ['language']);

            $instructors   = $userRepository->findUsers([
                'role_id' => 2,
                'q'       => $request->q,
                'status'  => 1,
                'take'    => 10,
            ], ['instructor']);

            $organizations = $organizationRepository->activeOrganization([
                'q'        => $request->q,
                'paginate' => 10,
            ]);

            $subjects      = $subjectRepository->activeSubject([
                'q'    => $request->q,
                'take' => setting('api_paginate'),
            ]);

            $tags          = $tagRepository->activeTags([
                'q'    => $request->q,
                'take' => setting('api_paginate'),
            ]);

            $levels        = $levelRepository->activeLevels([
                'q'    => $request->q,
                'take' => setting('api_paginate'),
            ]);

            $results       = [
                'courses'       => $courses,
                'categories'    => $categories,
                'instructors'   => $instructors,
                'organizations' => $organizations,
                'subjects'      => $subjects,
                'tags'          => $tags,
                'levels'        => $levels,
            ];

            $data          = [
                'html'    => view('frontend.header-search', $results)->render(),
                'success' => true,
            ];

            return response()->json($data);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ]);
        }
    }

    public function UpdateWebsiteSetting(Request $request, SettingRepository $setting): JsonResponse
    {
        if (config('app.demo_mode')) {
            $data = [
                'status' => 'danger',
                'error'  => __('this_function_is_disabled_in_demo_server'),
                'title'  => 'error',
            ];

            return response()->json($data);
        }

        try {

            $setting->update($request);
            $response = [
                'status'  => 'success',
                'title'   => 'success',
                'message' => __('update_successful'),
            ];
            Toastr::success(__('update_successful'));

            return response()->json($response);
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());
            $data = [
                'message' => __($e->getMessage()),
            ];

            return response()->json($data);
        }
    }

    public function page($link, PageRepository $pageRepository)
    {
        $page      = $pageRepository->findByLink($link);
        $lang      = $request->lang ?? app()->getLocale();
        $page_info = $pageRepository->getByLang($page->id, $lang);

        return view('frontend.page', compact('page_info'));
    }

    public function contact()
    {
        return view('frontend.contact_us');
    }

    public function privacyPolicy(PageRepository $pageRepository)
    {
        try {
            $page = \App\Models\Page::where('link', 'privacy-policy')->orWhere('link', 'privacy_policy')->first();
            if ($page) {
                $page_info = $pageRepository->getByLang($page->id, app()->getLocale());
                if ($page_info && !empty($page_info->content)) {
                    return view('frontend.page', compact('page_info'));
                }
            }
        } catch (\Exception $e) {}
        return view('frontend.privacy_policy');
    }

    public function termsPolicy(PageRepository $pageRepository)
    {
        try {
            $page = \App\Models\Page::where('link', 'terms-and-conditions')->orWhere('link', 'terms_conditions')->first();
            if ($page) {
                $page_info = $pageRepository->getByLang($page->id, app()->getLocale());
                if ($page_info && !empty($page_info->content)) {
                    return view('frontend.page', compact('page_info'));
                }
            }
        } catch (\Exception $e) {}
        return view('frontend.terms_conditions');
    }

    public function refundPolicy(PageRepository $pageRepository)
    {
        try {
            $page = \App\Models\Page::where('link', 'refund-policy')->orWhere('link', 'refund_policy')->first();
            if ($page) {
                $page_info = $pageRepository->getByLang($page->id, app()->getLocale());
                if ($page_info && !empty($page_info->content)) {
                    return view('frontend.page', compact('page_info'));
                }
            }
        } catch (\Exception $e) {}
        return view('frontend.refund_policy');
    }

    public function submitTestimonial(Request $request, \App\Repositories\SuccessStoryRepository $successStoryRepository)
    {
        $q = $request->q;
        $sorting = $request->sorting ?? 'latest';
        $style = $request->style ?? 'grid';

        $query = \App\Models\SuccessStory::active();

        if ($q) {
            $query->where(function($q_builder) use ($q) {
                $q_builder->where('title', 'like', "%{$q}%")
                          ->orWhere('description', 'like', "%{$q}%")
                          ->orWhere('position', 'like', "%{$q}%");
            });
        }

        if ($sorting == 'latest') {
            $query->latest();
        } elseif ($sorting == 'oldest') {
            $query->oldest();
        } elseif ($sorting == 'top_rated') {
            $query->orderByDesc('rating')->latest();
        }

        $total_success_stories = \App\Models\SuccessStory::active()->count();
        $successStories = $query->paginate(16);
        $total_results = $successStories->total();

        return view('frontend.submit_testimonial', compact('successStories', 'q', 'sorting', 'style', 'total_results', 'total_success_stories'));
    }

    public function successDetails($slug)
    {
        $story = \App\Models\SuccessStory::where('slug', $slug)->active()->firstOrFail();
        return view('frontend.success_details', compact('story'));
    }

    public function storeTestimonial(Request $request, \App\Repositories\SuccessStoryRepository $successStoryRepository)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'position' => 'nullable|string|max:255',
            'description' => 'required|string',
            'rating' => 'nullable|integer|min:1|max:5',
            'file' => 'nullable|file|mimes:jpeg,png,jpg,gif,svg,mp4,mov,ogg|max:20480',
            'profile_photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5120',
        ]);

        $data = $request->all();
        $data['status'] = 0; // pending
        $data['title'] = $data['name']; // map name to title for success story

        if ($request->hasFile('profile_photo')) {
            $photo = $request->file('profile_photo');
            $photoExtension = $photo->getClientOriginalExtension();
            $photoFilename = 'profile_' . time() . '.' . $photoExtension;
            $photo->move(public_path('uploads/testimonials'), $photoFilename);
            $photoPath = 'uploads/testimonials/' . $photoFilename;
            $data['image'] = [
                'storage' => 'local',
                'original_image' => $photoPath,
                'image_473x337' => $photoPath,
                'image_40x40' => $photoPath,
                'image_282x282' => $photoPath
            ];
        }

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move(public_path('uploads/testimonials'), $filename);
            
            $path = 'uploads/testimonials/' . $filename;
            
            if (in_array(strtolower($extension), ['mp4', 'mov', 'ogg'])) {
                $data['video'] = $path;
            } else {
                if (!isset($data['image']) || !is_array($data['image'])) {
                    $data['image'] = [
                        'storage' => 'local',
                        'original_image' => $path,
                        'image_473x337' => $path,
                        'image_40x40' => $path,
                        'image_282x282' => $path
                    ];
                } else {
                    $data['image']['original_image'] = $path;
                    $data['image']['image_473x337'] = $path;
                    $data['image']['image_282x282'] = $path;
                }
            }
        }

        $successStoryRepository->store($data);

        Toastr::success(__('success_story_submitted_successfully_pending_approval'));
        return redirect()->back()->with('success', 'Success story submitted successfully, pending approval.');
    }
}
