<?php

namespace Webkul\Product\Models;

use Illuminate\Database\Eloquent\Model;

class UpSellingProduct extends Model
{
    public $timestamps = false;

    protected $fillable = ['parent_id', 'child_id'];
}