@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6 text-start">
                                <h3>Create School Classes</h3>
                            </div>
                        </div>


                    </div>
                    <div class="card-body">
                        <form action="{{ route('schoolClass.store') }}" method="post">
                            @csrf

                            <div class="row mt-2">
                                <label for="name">Name</label>
                                <div class="col-6">
                                    <input class="form-control @error('name') is-invalid @enderror" type="text"
                                           name="name" value="{{ old('name') }}">
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
                                            <option value="{{ $teacher->id }}">{{ $teacher->name }}</option>
                                        @endforeach
                                    </select>
                                    @error('teacher_id')
                                    <span class="invalid-feedback" role="alert">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col-6">
                                    <button class="btn btn-success" type="submit">Add School Class</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
