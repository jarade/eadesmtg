<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CardType extends Model
{
    protected $table = 'cardtypes';
    protected $primaryKey = 'cardTypeID';

    public $timestamps = false;
}
