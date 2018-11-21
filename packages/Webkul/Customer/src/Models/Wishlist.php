<?php

namespace Webkul\Customer\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Product\Models\Product;

class Wishlist extends Model
{
    protected $table = 'wishlist';

    protected $fillable = ['channel_id', 'product_id', 'customer_id', 'item_options','moved_to_cart','shared','time_of_moving'];

<<<<<<< HEAD
    public function item_wishlist() {
        return $this->belongsTo(Product::class, 'product_id');
=======
    public function product() {
        return $this->hasOne(Product::class, 'id', 'product_id');
>>>>>>> 1c274447057da2b16e13a1b849e727667069c5aa
    }
}
