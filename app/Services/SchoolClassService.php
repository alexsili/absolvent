<?php

namespace App\Services;

use App\Models\SchoolClass;
use App\Repository\SchoolClassRepository;

class SchoolClassService
{
    public function __construct(
        protected SchoolClassRepository $schoolClassRepository
    ) {
    }

    public function store(array $data)
    {
        $this->schoolClassRepository->create($data);
    }

    public function update(SchoolClass $schoolClass, array $data)
    {
        $this->schoolClassRepository->update($schoolClass, $data);
    }

    public function delete(SchoolClass $schoolClass)
    {
        $schoolClass->delete();
    }

}
