<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ReceiptProduct extends Model
{
    protected $table = 'receiptproducts';
    protected $primaryKey = 'receiptProductsID';

    public $timestamps = false;
}
