<?php

namespace Petrik\Vizsgaremek;

use Illuminate\Database\Eloquent\Model;

class Rendezvenyek extends Model{
    protected $table = 'rendezmenyek';
    public $timestamps = false;

    protected $guarded = ['id'];

}