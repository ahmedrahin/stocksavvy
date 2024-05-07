<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;

    protected $guarded = [];

    // shop title
    public static function site_title() {
        $site_title = Settings::select('company_name')->first();
        return $site_title; 
    }

    // // shop fav icon
    public static function shop_fav() {
        $shop_fav = Settings::select('fav_icon')->first();
        return $shop_fav; 
    }
    // // shop logo
    public static function shop_logo() {
        $shop_logo = Settings::select('logo')->first();
        return $shop_logo; 
    }
    // shop email
    public static function shop_email() {
        $shop_email = Settings::select('email1')->first();
        return $shop_email; 
    }
    // shop address
    public static function shop_address() {
        $shop_email = Settings::select('address')->first();
        return $shop_email; 
    }
    //call 1
    public static function call_1() {
        $call_1 = Settings::select('phone1')->first();
        return $call_1; 
    }
    //city
    public static function city() {
        $city = Settings::select('city', 'zip')->first();
        return $city; 
    }
    
}
