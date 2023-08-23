@extends('layout.app')
@section('title', 'Edit Section')

@section('content')
    <div class="row d-flex justify-content-center align-items-center min-vh-100">
        <div class="col-md-10">
            <div class="p-4">
                <div class="p-2 grid-margin stretch-card">
                    <div class="row">
                        <div class="col-md-10">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Edit Section</h4>
                                </div>
                                <div class="card-body">
                                    <form action="{{ route('section.update', ['id' => $section->id]) }}" method="POST">
                                        @csrf
                                        @method('PUT')

                                        <div class="form-group">
                                            <label for="department_id">Department</label>
                                            <select id="department_id" class="form-control" name="department_id">
                                                <option value="">-- Select Department --</option>
                                                @foreach ($departments as $department)
                                                    <option value="{{ $department->id }}"{{ $section->department_id == $department->id ? ' selected' : '' }}>
                                                        {{ $department->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <label for="sectionname">Section</label>
                                            <input type="text" class="form-control" id="sectionname" name="name"
                                                value="{{ $section->name }}" placeholder="Section">
                                        </div>

                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
