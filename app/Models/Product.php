<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use NumberFormatter;

class Product extends Model
{
    use HasFactory;
    const STATUS_ACTIVE ='active';
    const STATUS_DRAFT ='draft';
    const STATUS_ARCHIVED ='archived';

    public static function statusOptions()
    {
        return [
            self::STATUS_ACTIVE   => 'Active',
            self::STATUS_DRAFT    => 'Draft',
            self::STATUS_ARCHIVED => 'Archived',
            
        ];
    }
    public function getImageUrlAttribute() 
    {
        if($this->image){
            return Storage::disk('public')->url($this->image);
        }
        return'http://placehold.co/60x60/orange/white?text=No+Image';
    }

    public function getNameUrlAttribute($value) 
    {
        return ucwords($value);
    }
    public function getPriceFormattedUrlAttribute($value) 
    {
        $foramtter = new NumberFormatter('en',NumberFormatter::CURRENCY);
        return $foramtter->formatCurrency($this->price,'EUR');
    }
}
