<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentModel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'matricNo',
    ];
}
