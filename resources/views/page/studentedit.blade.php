@extends('layout.app')
@section('title', 'Edit User')

@section('content') 

    <div class="container">
        <div class="row justify-content-center align-items-center">
            <div class="col-md-8">
                <div class="card bg-light mt-3">
                    <div class="card-header">
                        <h3>Edit User</h3>
                    </div>

                    <div class="card-body">
                        <form action="{{ url('studentupdate', $user->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="department">Department</label>
                                <select id="department" class="form-control" name="department_id">
                                    <option value="">-- Select Department --</option>
                                    @foreach ($departments as $department)
                                        <option value="{{ $department->id }}" {{ $user->department_id == $department->id ? 'selected' : '' }}>{{ $department->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="section">Section</label>
                                <select id="section" class="form-control" name="section_id" >
                                    <option value="">-- Select Section --</option>
                                    @foreach ($sections as $sec)
                                        <option value="{{ $sec->id }}" {{ $user->section_id == $sec->id ? 'selected' : '' }}>{{ $sec->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="batch">Batch</label>
                                <select id="batch" class="form-control" name="batch_id" >
                                    <option value="">-- Select Batch --</option>
                                    @foreach ($batches as $bat)
                                        <option value="{{ $bat->id }}" {{ $user->batch_id == $bat->id ? 'selected' : '' }}>{{ $bat->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <button class="btn btn-primary">Update User</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
