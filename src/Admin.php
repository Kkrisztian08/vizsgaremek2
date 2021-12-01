<?php

namespace Petrik\Vizsgaremek;

use Illuminate\Database\Eloquent\Model;

class Admin extends Model{
    protected $table = 'admin';
    public $timestamps = false;

    protected $guarded = ['id'];
}