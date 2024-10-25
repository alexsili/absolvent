<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\SchoolClassRequest;
use App\Models\SchoolClass;
use App\Models\User;
use App\Services\SchoolClassService;
use Illuminate\Support\Facades\Auth;

class SchoolClassController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'director') {
            $schoolClasses = SchoolClass::with('students')->get();
        } elseif ($user->role === 'teacher') {
            $schoolClasses = $user->schoolClasses()->with('students')->get();
        }

        return view('school-classes.index')->with('schoolClasses', $schoolClasses);

    }

    public function create()
    {
        $teachers = User::where('role', 'teacher')->get();

        return view('school-classes.create')->with('teachers', $teachers);
    }

    public function store(SchoolClassRequest $request)
    {
        resolve(SchoolClassService::class)->store($request->getSchoolClassData());

        return redirect()->route('home')->with('success', 'School Class added successfully');
    }

    public function show(string $id)
    {
        $user = Auth::user();

        if ($user->role === 'director') {
            $schoolClass = SchoolClass::with('students')->find($id);
        } elseif ($user->role === 'teacher') {
            $schoolClass = $user->schoolClasses()->where('id', $id)->with('students')->first();
        }

        return view('school-classes.show')->with('schoolClass', $schoolClass);

    }

    public function edit(SchoolClass $schoolClass)
    {
        $teachers = User::where('role', 'teacher')->get();

        return view('school-classes.edit')
            ->with('teachers', $teachers)
            ->with('schoolClass', $schoolClass);
    }

    public function update(SchoolClassRequest $request, SchoolClass $schoolClass)
    {
        resolve(SchoolClassService::class)->update($schoolClass, $request->getSchoolClassData());

        return redirect()->route('home')->with('success', 'School Class was updated successfully');
    }

    public function destroy(SchoolClass $schoolClass)
    {
        resolve(SchoolClassService::class)->delete($schoolClass);

        return redirect()->route('home')->with('success', 'The School Class was successfully deleted!');
    }
}
