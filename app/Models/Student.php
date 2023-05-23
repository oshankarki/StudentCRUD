<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Education;

class Student extends Model
{
    use HasFactory;

    protected $table = 'students';
    protected $fillable = ['name', 'email', 'phone', 'address', 'image', 'gender', 'dob'];

    public function educations()
    {
        return $this->hasMany(Education::class, 'student_id', 'id');
    }
}
