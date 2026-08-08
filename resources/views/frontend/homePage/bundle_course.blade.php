<section class="top-courses-section p-t-80 p-b-50 p-t-sm-40 p-b-sm-50">
    <div class="container container-1278">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="common-heading text-center m-b-40 m-b-sm-25">
                    <h3>{{__($section->contents['title']) }}</h3>
                    <p>{{__($section->contents['sub_title']) }}</p>
                </div>
            </div>
        </div>
        <!-- Start Top Course Tabs -->
        <div class="main-tabs">
            <div class="education-level-tab-content tab-content" id="education-level-tabContent">
                <div class="tab-pane fade show active" id="all-courses" role="tabpanel"
                     aria-labelledby="all-courses-tab">
                    <div class="row course-items-v3">
                        @foreach($bundle_courses as $key => $course)
                            @include('frontend.course.component',['col' => 'col-lg-4'])
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <!-- End Top Course Tabs -->
    </div>
</section>


