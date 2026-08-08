<?php

namespace App\Services\Admin\Dashboard;

use App\Models\Course;
use Illuminate\Http\Request;

class BestInstructors
{
    public function execute(Request $request)
    {
        if ($request->best_instructors) {
            return app(DateWiseQuery::class)->query($request, Course::withCount('enrolls')->whereHas('instructor')->with('enrolls')->whereHas('enrolls'))
                ->orderByDesc('enrolls_count')
                ->limit(10)
                ->get();
        }

        return Course::withCount('enrolls')->whereHas('instructor')->with('enrolls')->whereHas('enrolls')->orderBy('enrolls_count', 'desc')->limit(10)->get();
        //        dd($return);
    }
}
