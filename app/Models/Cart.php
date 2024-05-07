<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $guarded = [];

    // product
    public function product(){
        return $this->belongsTo(Product::class);
    }

    // how many items in the cart
    public static function totalQunt(){
        $totalQunt = 0;
        $carts = Cart::where('order_id', NULL)->orderBy('created_at', 'desc')->get();

        foreach( $carts as $cart ){
           if( $cart->product->status == 1 ){
                $totalQunt += $cart->product_quantity;
           }
        }
        return $totalQunt;
    }

     // how many product in the cart
     public static function totalItems(){

        $carts = Cart::where('order_id', NULL)->orderBy('created_at', 'desc')->get();
        return $carts;
    }

    // total amount
    public static function totalAmount(){
        $totalAmount = 0;
        $carts = Cart::where('order_id', NULL)->orderBy('created_at', 'desc')->get();
        
        foreach( $carts as $cart ){
            if( $cart->product->status == 1 ){
                $totalAmount += $cart->product_quantity * $cart->product->selling_price ;
            }
        }
        return $totalAmount;
    }

}
