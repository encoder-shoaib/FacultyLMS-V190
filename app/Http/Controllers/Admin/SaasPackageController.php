<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\SaasPackageDatatable;
use App\Http\Controllers\Controller;
use App\Repositories\LanguageRepository;
use App\Repositories\SaasPackageRepository;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SaasPackageController extends Controller
{
    public function __construct(protected SaasPackageRepository $packageRepository) {}

    public function index(SaasPackageDataTable $dataTable)
    {
        try {
            return $dataTable->render('backend.admin.saas_package.index');
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function create(): View|Factory|Application|RedirectResponse
    {
        try {
            return view('backend.admin.saas_package.create');
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function store(Request $request): JsonResponse
    {
        if (config('app.demo_mode')) {
            $data = [
                'status' => 'danger',
                'error'  => __('this_function_is_disabled_in_demo_server'),
                'title'  => 'error',
            ];

            return response()->json($data);
        }

        $request->validate([
            'title'            => 'required|unique:saas_packages,title',
            'price'            => 'required_without:is_free|numeric|min:0',
            'days'             => 'required|numeric',
            'total_instructor' => 'required',
            'total_course'     => 'required',
        ]);
        DB::beginTransaction();
        try {
            $this->packageRepository->store($request->all());
            DB::commit();

            Toastr::success(__('create_successful'));

            return response()->json([
                'success' => __('create_successful'),
                'route'   => route('saas-packages.index'),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function edit($id, LanguageRepository $language, Request $request): View|Factory|RedirectResponse|Application
    {
        try {
            $package = $this->packageRepository->find($id);
            $lang    = $request->lang ?? app()->getLocale();

            $data    = [
                'languages'        => $language->all(),
                'lang'             => $lang,
                'package'          => $package,
                'package_language' => $this->packageRepository->getByLang($id, $lang),
            ];

            return view('backend.admin.saas_package.edit', $data);
        } catch (\Exception $e) {
            Toastr::error($e->getMessage());

            return back();
        }
    }

    public function update(Request $request, $id): JsonResponse
    {
        if (config('app.demo_mode')) {
            $data = [
                'status' => 'danger',
                'error'  => __('this_function_is_disabled_in_demo_server'),
                'title'  => 'error',
            ];

            return response()->json($data);
        }
        $request->validate([
            'title'            => 'required|unique:saas_packages,title,'.$id,
            'price'            => 'required_without:is_free|numeric|min:0',
            'days'             => 'required|numeric',
            'total_instructor' => 'required',
            'total_course'     => 'required',
        ]);
        DB::beginTransaction();
        try {
            $this->packageRepository->update($request->all(), $id);
            DB::commit();
            Toastr::success(__('update_successful'));

            return response()->json([
                'success' => __('update_successful'),
                'route'   => route('saas-packages.index'),
            ]);

        } catch (\Exception $e) {
            DB::rollBack();

            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function destroy($id): JsonResponse
    {
        if (config('app.demo_mode')) {
            $data = [
                'status'  => 'danger',
                'message' => __('this_function_is_disabled_in_demo_server'),
                'title'   => 'error',
            ];

            return response()->json($data);
        }
        try {
            $this->packageRepository->destroy($id);

            $data = [
                'status'  => 'success',
                'message' => __('delete_successful'),
                'title'   => __('success'),
            ];

            return response()->json($data);

        } catch (\Exception $e) {

            $data = [
                'status'  => 400,
                'message' => $e->getMessage(),
                'title'   => 'error',
            ];

            return response()->json($data);
        }
    }

    public function statusChange(Request $request): JsonResponse
    {
        if (config('app.demo_mode')) {
            $data = [
                'status'  => 'danger',
                'message' => __('this_function_is_disabled_in_demo_server'),
                'title'   => 'error',
            ];

            return response()->json($data);
        }
        try {
            $this->packageRepository->statusChange($request->all());

            $data = [
                'status'  => 200,
                'message' => __('update_successful'),
                'title'   => 'success',
            ];

            return response()->json($data);

        } catch (\Exception $e) {

            $data = [
                'status'  => 400,
                'message' => $e->getMessage(),
                'title'   => 'error',
            ];

            return response()->json($data);
        }
    }
}
