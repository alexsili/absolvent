<?php

namespace App\Services;

use App\Models\Student;
use App\Repository\StudentsRepository;

class StudentsService
{
    public function __construct(
        protected StudentsRepository $studentsRepository
    ) {
    }

    public function store(array $data)
    {
        $this->studentsRepository->create($data);
    }

    public function update(Student $student, array $data)
    {
        $this->studentsRepository->update($student, $data);
    }

    public function delete(Student $student)
    {
        $student->delete();
    }

}
