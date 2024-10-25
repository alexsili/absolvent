@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6 text-start">
                                <h3>{{ $schoolClass->name }}</h3>
                            </div>
                            @if(auth()->user()->role === 'director')
                                <div class="col-6 text-end">
                                    <a class="btn btn-success" href="{{ route('students.create', $schoolClass) }}">Add
                                        Students</a>
                                </div>
                            @endif
                        </div>
                    </div>
                    <div class="card-body">
                        <table class="table">
                            <thead>
                            <tr>
                                <th scope="col">Id</th>
                                <th scope="col">Name</th>
                                <th scope="col">School Class</th>
                                @if(auth()->user()->role === 'director')
                                    <th scope="col">Actions</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($schoolClass->students as $student)
                                <tr>
                                    <th scope="row">{{ $student->id }}</th>
                                    <td>{{ $student->name }}</td>
                                    <td>{{ $student->schoolClass->name }}</td>
                                    <td>
                                        @if(auth()->user()->role === 'director')
                                            <a class="btn btn-warning btn-sm"
                                               href="{{ route('students.edit', [$schoolClass, $student]) }}">
                                                <i class="fa-solid fa-pen-to-square"></i>
                                            </a>
                                    </td>
                                    @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
