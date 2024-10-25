@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6 text-start">
                                <h3>Update School Class</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('schoolClass.update', $schoolClass) }}" method="post">
                            @csrf

                            <div class="row mt-2">
                                <label for="name">Name</label>
                                <div class="col-6">
                                    <input class="form-control @error('name') is-invalid @enderror" type="text"
                                           name="name"
                                           value="{{ $schoolClass->name }}">
                                    @error('name')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-2">
                                <label for="teacher_id">Teacher</label>
                                <div class="col-6">
                                    <select class="form-control @error('teacher_id') is-invalid @enderror"
                                            name="teacher_id" id="teacher_id">
                                        @foreach($teachers as $teacher)
                                            <option value="{{ $teacher->id }}"
                                                    @if($schoolClass->teacher_id ==$teacher->id ) selected @endif>{{ $teacher->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('teacher_id')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-6">
                                    <button class="btn btn-success" type="submit">Edit School Class</button>
                                    @if(auth()->user()->role === 'director')
                                        <button type="button" class="btn btn-danger mx-3" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal">
                                            <i class="fa-solid fa-trash "></i>
                                        </button>
                                    @endif
                                </div>

                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <form action="{{ route('schoolClass.destroy', $schoolClass) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Delete School Class</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure to delete this school class?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
