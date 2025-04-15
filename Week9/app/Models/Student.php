<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Student extends Model
{
    /** @use HasFactory<\Database\Factories\StudentFactory> */
    use HasFactory;

    protected $fillable = [
        'fname',
        'lname',
        'email'
    ];

    protected $dates = ['deleted_at'];

    public function courses():BelongsToMany
    {
        return $this -> belongsToMany(Course::class);
    }
}


