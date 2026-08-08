<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class SaasPackage extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'description', 'price', 'days', 'total_instructor', 'total_course', 'is_popular', 'status'];

    public function languages(): HasMany
    {
        return $this->hasMany(SaasPackageLanguage::class);
    }

    public function language(): HasOne
    {
        return $this->hasOne(SaasPackageLanguage::class)->where('lang', app()->getLocale());
    }

    public function getLangTitleAttribute()
    {
        return $this->language ? $this->language->title : $this->title;
    }

    public function getLangDescriptionAttribute()
    {
        return $this->language ? $this->language->description : $this->description;
    }
}
