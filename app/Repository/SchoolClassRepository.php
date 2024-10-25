<?php

namespace App\Repository;

use App\Models\SchoolClass;

class SchoolClassRepository extends BaseRepository
{
    public function __construct(SchoolClass $schoolClass)
    {
        $this->model = $schoolClass;
    }
}