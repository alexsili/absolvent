@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6 text-start">
                                <h3>School Classes</h3>
                            </div>
                            @if(auth()->user()->role === 'director')
                                <div class="col-6 text-end">
                                    <a class="btn btn-success" href="{{ route('schoolClass.create') }}">Add School
                                        Class</a>
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
                                <th scope="col">Teacher</th>
                                @if(auth()->user()->role === 'director')
                                    <th scope="col">Actions</th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($schoolClasses as $schoolClass)
                                <tr>
                                    <th scope="row">{{ $schoolClass->id }}</th>
                                    <td><a href="{{ route('show', $schoolClass->id) }}"> {{ $schoolClass->name }}</a>
                                    </td>
                                    <td>{{ $schoolClass->teacher->name }}</td>
                                    @if(auth()->user()->role === 'director')
                                        <td>
                                            <a class="btn btn-warning btn-sm"
                                               href="{{ route('schoolClass.edit', $schoolClass) }}">
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
