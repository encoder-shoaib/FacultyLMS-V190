<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Subscription extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'org_id', 'saas_package_id', 'days', 'total_instructor', 'total_course', 'payment_method', 'offline_method_id', 'offline_method_file', 'amount', 'trx_id', 'purchase_at',
        'expires_at', 'payment_details', 'status'];

    protected $casts    = [
        'offline_method_file' => 'array',
        'payment_details'     => 'array',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function package(): BelongsTo
    {
        return $this->belongsTo(SaasPackage::class, 'saas_package_id');
    }

    public function organization(): BelongsTo
    {
        return $this->belongsTo(Organization::class, 'org_id', 'id');
    }
}
