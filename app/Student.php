<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $fillable = ['nisn','nama','kelas','jurusan'];
    protected $hidden = ['created_at','updated_at'];
}
