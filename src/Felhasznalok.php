<?php

namespace Petrik\Vizsgaremek;

use Illuminate\Database\Eloquent\Model;

class Felhasznalok extends Model{
    protected $table = 'felhasznalok';
    public $timestamps = false;

    protected $guarded = ['id'];

}