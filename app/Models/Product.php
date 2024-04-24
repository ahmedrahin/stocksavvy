<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    // category
    public function category(){
        return $this->belongsTo(Category::class, 'cat_id');
    }

    // supplier
    public function supplier(){
        return $this->belongsTo(Suplliers::class, 'sup_id');
    }
}
