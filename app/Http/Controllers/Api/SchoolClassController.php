<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\SchoolClassRequest;
use App\Models\SchoolClass;
use App\Services\SchoolClassService;
use Illuminate\Support\Facades\Auth;

class SchoolClassController extends Controller
{
    public function __construct()
    {
        $this->middleware('apiJson');
    }

    public function index()
    {
        $user = Auth::user();

        if ($user->role === 'director') {
            $schoolClasses = SchoolClass::with('students')->get();
        } elseif ($user->role === 'teacher') {
            $schoolClasses = $user->schoolClasses()->with('students')->get();
        }

        return response()->json($schoolClasses);
    }

    public function store(SchoolClassRequest $request)
    {
        resolve(SchoolClassService::class)->store($request->getSchoolClassData());

        return response()->json([
            'message' => 'School Class created successfully'
        ]);
    }

    public function show(string $id)
    {
        $user = Auth::user();

        if ($user->role === 'director') {
            $schoolClass = SchoolClass::with('students')->find($id);
        } elseif ($user->role === 'teacher') {
            $schoolClass = $user->schoolClasses()->where('id', $id)->with('students')->first();
        }

        if (!$schoolClass) {
            return response()->json(['message' => 'The School Class was not found!'], 404);
        }

        return response()->json($schoolClass);
    }

    public function update(SchoolClassRequest $request, SchoolClass $schoolClass)
    {
        resolve(SchoolClassService::class)->update($schoolClass, $request->getSchoolClassData());

        return response()->json([
            'message' => 'School Class was updated successfully',
            'data' => $schoolClass
        ]);
    }

    public function destroy(SchoolClass $schoolClass)
    {
        resolve(SchoolClassService::class)->delete($schoolClass);

        return response()->json(['message' => 'The School Class was successfully deleted!']);
    }
}
