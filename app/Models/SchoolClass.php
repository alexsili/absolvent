<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Laravel\Sanctum\HasApiTokens;

class SchoolClass extends Model
{
    use  HasFactory, HasApiTokens;

    protected $fillable = [
        'teacher_id',
        'name',
        'created_at',
        'updated_at'

    ];

    protected $table = 'school_classes';

    public function students(): HasMany
    {
        return $this->hasMany(Student::class);
    }

    public function teacher()
    {
        return $this->belongsTo(User::class);
    }

}
