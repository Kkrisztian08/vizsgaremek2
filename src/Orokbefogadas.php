<?php

namespace Petrik\Vizsgaremek;

use Illuminate\Database\Eloquent\Model;

class Orokbefogadas extends Model{
    protected $table = 'orokbefogadas';
    public $timestamps = false;

    protected $guarded = ['id'];

}