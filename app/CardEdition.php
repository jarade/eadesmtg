<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CardEdition extends Model
{
    protected $table = 'cardeditions';
    protected $primaryKey = 'cardEdID';

    public $timestamps = false;
}
