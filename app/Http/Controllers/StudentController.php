<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentsRequest;
use App\Models\SchoolClass;
use App\Models\Student;
use App\Services\StudentsService;

class StudentController extends Controller
{

    public function create(SchoolClass $schoolClass)
    {
        return view('students.create')->with('schoolClass', $schoolClass);
    }

    public function store(StudentsRequest $request)
    {
        resolve(StudentsService::class)->store($request->getStudentsData());

        return redirect()->route('home')->with('success', 'The student created successfully');
    }

    public function edit(SchoolClass $schoolClass, Student $student)
    {
        return view('students.edit')
            ->with('student', $student);
    }

    public function update(StudentsRequest $request, Student $student)
    {
        resolve(StudentsService::class)->update($student, $request->getStudentsData());

        return redirect()->route('home')->with('success', 'School Class was updated successfully');
    }

    public function destroy(Student $student)
    {
        resolve(StudentsService::class)->delete($student);

        return redirect()->route('home')->with('success', 'The student was successfully deleted!');

    }
}
