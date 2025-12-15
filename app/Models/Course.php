<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Course extends Model
{
        use HasFactory;

    protected $fillable = [
        'courseName',
        'courseCode',
        'creditHour',
    ];


    public function Student()
        {
            return $this->belongsToMany(StudentModel::class);
        }
}

