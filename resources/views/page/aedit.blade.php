@extends('layout.app')
@section('title', 'Edit Allocation')

@section('content')
<div class="row d-flex justify-content-center align-items-center min-vh-100">
    <div class="col-md-10">
        <div class="p-4">
            <div class="p-2 grid-margin stretch-card">
                <div class="row">
                    <div class="col-md-10">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Edit Allocation</h4>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('aupdate', $allocation->id) }}" method="POST">
                                    @csrf
                                    @method('POST')
                                    <div class="form-group">
                                        <label for="batch">Batch</label>
                                        <select id="batch-dropdown" class="form-control" name="batch_id">
                                            <option value="">-- Select Batch--</option>
                                            @foreach ($batchs as $data)
                                            <option value="{{ $data->id }}" {{ $allocation->batch_id == $data->id ? 'selected' : '' }}>
                                                {{ $data->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <br>
                                    <div class="form-group">
                                        <select id="department-dropdown" class="form-control" name="department_id">
                                            <option value="">-- Select Department--</option>
                                            @foreach ($departments as $data)
                                            <option value="{{ $data->id }}" {{ $allocation->department_id == $data->id ? 'selected' : '' }}>
                                                {{ $data->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="Section">Section</label>
                                        <select id="section-dropdown" class="form-control" name="section_id">
                                            <option value="">-- Select Section--</option>
                                            @foreach ($sections as $data)
                                            <option value="{{ $data->id }}" {{ $allocation->section_id == $data->id ? 'selected' : '' }}>
                                                {{ $data->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="course">Course</label>
                                        <select id="course-dropdown" class="form-control" name="course_id">
                                            <option value="">-- Select Course--</option>
                                            @foreach ($courses as $data)
                                            <option value="{{ $data->id }}" {{ $allocation->course_id == $data->id ? 'selected' : '' }}>
                                                {{ $data->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="trainer1">Trainer 1</label>
                                        <select id="trainer-dropdown1" class="form-control" name="trainer1_id">
                                            <option value="">-- Select Trainer 1--</option>
                                            @foreach ($trainers as $data)
                                            <option value="{{ $data->id }}" {{ $allocation->trainer1_id == $data->id ? 'selected' : '' }}>
                                                {{ $data->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="trainer2">Trainer 2</label>
                                        <select id="trainer-dropdown2" class="form-control" name="trainer2_id">
                                            <option value="">-- Select Trainer 2--</option>
                                            @foreach ($trainers as $data)
                                            <option value="{{ $data->id }}" {{ $allocation->trainer2_id == $data->id ? 'selected' : '' }}>
                                                {{ $data->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <br>
                                    <button type="submit" class="btn btn-primary me-2">Update</button>
                                    <a href="{{ route('allocate') }}" class="btn btn-light">Cancel</a>
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
