<?php

namespace App\Models;

use Attribute;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Storage;
use NumberFormatter;

class Product extends Model
{
    use HasFactory, SoftDeletes;
     //ثوابت
    const STATUS_ACTIVE = 'active';
    const STATUS_DRAFT = 'draft';
    const STATUS_ARCHIVED = 'archived';

    protected $fillable = [
        'name', 'slug', 'category_id', 'description', 'short_description',
         'price', 'compare_price', 'image', 'status'
    ];

    // protected $guarded = ['id'];

    protected static function booted()
    {
        static::addGlobalScope('owner', function(Builder $query) {
            $query->where('user_id', '=', 1);
        });
    }

    public function scopeActive(Builder $query){
        $query->where('status', '=', 'active');

    }
    public function scopeStatus(Builder $query, $status){
        $query->where('status', '=', $status);

    }

    public static function statusOptions()
    {
        return [
            self::STATUS_ACTIVE   => 'Active',
            self::STATUS_DRAFT    => 'Draft',
            self::STATUS_ARCHIVED => 'Archived',

        ];
    }

    //public function scope
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return Storage::disk('public')->url($this->image);
        }
        return 'http://placehold.co/600x600/orange/white?text=No+Image';
    }
    // public function getImageAttribute($value)
    // {
    //     if ($value) {
    //         return Storage::disk('public')->url($value);
    //     }
    //     return 'http://placehold.co/600x600/orange/white?text=No+Image';
    // }

    public function getNameAttribute($value)
    {
        return ucwords($value);
    }

    public function getPriceFormattedAttribute()
    {
        $foramtter = new NumberFormatter(config('app.locale'), NumberFormatter::CURRENCY);
        return $foramtter->formatCurrency($this->price, 'USD');
    }
}
