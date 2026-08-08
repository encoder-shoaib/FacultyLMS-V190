<?php

namespace App\Repositories;

use App\Models\SaasPackage;
use App\Models\SaasPackageLanguage;
use App\Models\Subscription;
use App\Traits\PaymentTrait;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Collection;

class SaasPackageRepository
{
    use PaymentTrait;

    public function all(): LengthAwarePaginator
    {
        return SaasPackage::with('language')->latest()->paginate(setting('pagination'));
    }

    public function activeSaasPackages(): Collection|array
    {
        return SaasPackage::with('language')->where('status', 1)->get();
    }

    public function store($request)
    {
        $request['is_free'] = $request['price'] == 0;
        $request['status']  = 1;
        $package            = SaasPackage::create($request);
        $this->langStore($request, $package);

        return $package;
    }

    public function getByLang($id, $lang)
    {
        if (! $lang) {
            $department = SaasPackageLanguage::where('lang', 'en')->where('saas_package_id', $id)->first();
        } else {
            $department = SaasPackageLanguage::where('lang', $lang)->where('saas_package_id', $id)->first();
            if (! $department) {
                $department                     = SaasPackageLanguage::where('lang', 'en')->where('saas_package_id', $id)->first();
                $department['translation_null'] = 'not-found';
            }
        }

        return $department;
    }

    public function find($id)
    {
        return SaasPackage::find($id);
    }

    public function update($request, $id)
    {
        $request['is_free'] = $request['price'] == 0;
        $department         = SaasPackage::find($id);
        $data               = $request;

        if (arrayCheck('lang', $request) && $request['lang'] != 'en') {
            $request['title'] = $department->title;
        }

        if ($request['translate_id']) {
            $request['lang'] = $request['lang'] ?: 'en';
            $this->langUpdate($data);
        } else {
            $this->langStore($data, $department);
        }

        return $department->update($request);
    }

    public function destroy($id): int
    {
        return SaasPackage::destroy($id);
    }

    public function statusChange($request)
    {
        $id = $request['id'];

        return SaasPackage::find($id)->update($request);
    }

    public function langStore($request, $package)
    {
        return SaasPackageLanguage::create([
            'saas_package_id' => $package->id,
            'title'           => $request['title'],
            'description'     => $request['description'],
            'lang'            => arrayCheck('lang', $request) ? $request['lang'] : 'en',
        ]);
    }

    public function langUpdate($request)
    {
        return SaasPackageLanguage::where('id', $request['translate_id'])->update([
            'lang'        => $request['lang'],
            'title'       => $request['title'],
            'description' => $request['description'],
        ]);
    }

    public function subscription($data)
    {
        $package = $this->find($data['saas_package_id']);

        if ($data['payment_type'] == 'offline_method') {
            $payment_details = [];
            if (arrayCheck('offline_method_file', $data)) {
                $storage         = setting('default_storage') == 'aws_s3' ? 'aws_s3' : 'local';
                $fileName        = time().'.'.$data['offline_method_file']->extension();
                $data['offline_method_file']->move(public_path('images/orders/'), $fileName);

                $payment_details = [
                    'storage' => $storage,
                    'image'   => 'images/orders/'.$fileName,
                ];
            }
        } else {
            $payment_details = $this->methodCheck($data);

            if (! $this->successStatusCheck($data, $payment_details)) {
                return __('transaction_cant_be_completed');
            }
        }
        $data    = [
            'user_id'             => auth()->id(),
            'org_id'              => authOrganizationId(),
            'saas_package_id'     => $package->id,
            'days'                => $package->days,
            'total_instructor'    => $package->total_instructor,
            'total_course'        => $package->total_course,
            'payment_method'      => $data['payment_type'],
            'offline_method_id'   => getArrayValue('offline_method_id', $data, 0),
            'offline_method_file' => [],
            'amount'              => $package->price,
            'trx_id'              => $data['trx_id'],
            'purchase_at'         => now(),
            'expires_at'          => now()->addDays($package->days),
            'payment_details'     => $payment_details,
        ];

        Subscription::where('user_id', auth()->id())->update(['status' => 0]);

        return Subscription::create($data);
    }
}
