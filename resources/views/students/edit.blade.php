@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6 text-start">
                                <h3>Update Student</h3>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('students.update', $student) }}" method="post">
                            @csrf

                            <div class="row mt-2">
                                <label for="name">Name</label>
                                <div class="col-6">
                                    <input class="form-control @error('name') is-invalid @enderror" type="text"
                                           name="name"
                                           value="{{ $student->name }}">
                                    @error('name')<span class="invalid-feedback"
                                                        role="alert">{{ $message }}</span>@enderror
                                </div>
                                <input name="school_class_id" type="hidden" value="{{ $student->school_class_id }}">
                            </div>
                            <div class="row mt-4">
                                <div class="col-6">
                                    <button class="btn btn-success" type="submit">Edit Student</button>
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
                <form action="{{ route('students.destroy', $student) }}" method="post">
                    @csrf
                    @method('DELETE')
                    <div class="modal-header">
                        <h5 class="modal-title" id="deleteModalLabel">Delete Student</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        Are you sure to delete this student?
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
