<?php

namespace App\Http\Controllers\Api\Student;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\MyBlogResource;
use App\Models\Blog;
use App\Repositories\BlogRepository;
use App\Traits\ApiReturnFormatTrait;

class BlogController extends Controller
{
    use ApiReturnFormatTrait;

    protected $blogRepository;

    public function __construct(BlogRepository $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }

    public function blogDetails($slug): \Illuminate\Http\JsonResponse
    {
        try {
            $blog           = Blog::withCount('comments')->where('slug', $slug)->where('status', 'published')->with('user')->first();
            $all_blogs      = Blog::withCount('comments')->where('status', 'published')->whereNot('id', $blog->id)->with('user')->latest()->take(2)->get();
            $featured_blogs = Blog::withCount('comments')->where('status', 'published')->whereNot('id', $blog->id)->with('user')->where('is_featured', 1)->latest()->take(2)->get();

            $userId         = jwtUser() ? jwtUser()->id : null;

            if ($userId === null) {
                $commentStatus = 0;
            } else {
                $commentStatus = $this->blogRepository->isCommented([
                    'user_id' => $userId,
                    'blog_id' => $blog->id,
                ]) ?? 0;
            }

            $data           = [
                'blog'           => new MyBlogResource($blog),
                'all_blogs'      => MyBlogResource::collection($all_blogs),
                'featured_blogs' => MyBlogResource::collection($featured_blogs),
                'comment'        => $commentStatus,
            ];

            return $this->responseWithSuccess(__('blog_data_retrieved_successfully'), $data);
        } catch (\Exception $e) {
            return $this->responseWithError($e->getMessage());
        }
    }
}
