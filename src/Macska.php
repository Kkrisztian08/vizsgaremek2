<?php

namespace Petrik\Vizsgaremek;

use Illuminate\Database\Eloquent\Model;

class Macska extends Model{
    protected $table = 'macska';
    public $timestamps = false;

    protected $guarded = ['id'];

}