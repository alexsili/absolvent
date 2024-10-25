<?php

namespace App\Repository;

use App\Models\SchoolClass;
use App\Models\Student;

class StudentsRepository extends BaseRepository
{
    public function __construct(Student $student)
    {
        $this->model = $student;
    }
}