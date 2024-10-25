<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StudentsRequest;
use App\Models\Student;
use App\Services\StudentsService;
use Illuminate\Support\Facades\Auth;

class StudentController extends Controller
{
    public function __construct()
    {
        $this->middleware('apiJson');
    }

    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'director') {
            $students = Student::all();
        } elseif ($user->role === 'teacher') {
            $students = $user->students()->get();
        }

        return response()->json($students);
    }


    public function store(StudentsRequest $request)
    {
        resolve(StudentsService::class)->store($request->getStudentsData());

        return response()->json([
            'message' => 'The student created successfully'
        ]);
    }

    public function show(string $id)
    {
        $user = Auth::user();
        $student = Student::with('schoolClass')->find($id);

        if (!$student) {
            return response()->json(['message' => 'The student was not found!'], 404);
        }

        if ($user->role === 'director') {
            return response()->json($student);
        } elseif ($user->role === 'teacher') {
            $schoolClass = $user->schoolClasses()->where('id', $student->school_class_id)->first();

            if (!$schoolClass) {
                return response()->json(['message' => 'Unauthorized to view this student'], 403);
            }

            return response()->json($student);
        }

        return response()->json(['message' => 'Unauthorized'], 403);
    }

    public function update(StudentsRequest $request, Student $student)
    {
        resolve(StudentsService::class)->update($student, $request->getStudentsData());

        return response()->json([
            'message' => 'The student was updated successfully',
            'data' => $student
        ]);
    }

    public function destroy(Student $student)
    {
        resolve(StudentsService::class)->delete($student);

        return response()->json(['message' => 'The student was successfully deleted!']);

    }
}
