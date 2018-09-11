<?php
namespace Webkul\Customer\Models;

use Illuminate\Database\Eloquent\Model;
use Webkul\Product\Models\Product;

class CustomerReview extends Model
{
    protected $fillable = [];

    protected $table = 'product_reviews';

    public function with_product() {
       return $this->belongsTo(Product::class,'product_id');
    }

}




