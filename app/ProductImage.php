<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $table = 'productimages';
    protected $primaryKey = 'imageID';

    public $timestamps = false;
}
