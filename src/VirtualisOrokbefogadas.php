<?php

namespace Petrik\Vizsgaremek;

use Illuminate\Database\Eloquent\Model;

class VirtualisOrokbefogadas extends Model{
    protected $table = "virtualis_orokbefogadas";
    public $timestamps = false;
    
    protected $guarded = ['id'];
}