<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaasPackageLanguage extends Model
{
    use HasFactory;

    protected $fillable = [
        'saas_package_id',
        'lang',
        'title',
        'description',
    ];
}
