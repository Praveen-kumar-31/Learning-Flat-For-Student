@extends('layout.app')
@section('title', 'Upload')

@section('content')

<div class="container">
    <div class="row mt-5 mx-5">
        <div class="col-md-8">
            <div class="card bg-light mt-3">
                <div class="card-header">
                    <h3>Student Data</h3>
                </div>

                <div class="card-body">
                    <form action="{{ route('import_user') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <input type="file" name="excel_file" class="form-control">
                        </div>
                        @error('excel_file')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror

                        <div class="form-group">
                            <label for="department">Department</label>
                            <select id="department" class="form-control" name="department_id">
                                <option value="">-- Select Department --</option>
                                @foreach ($departments as $department)
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="section">Section</label>
                            <select id="section" class="form-control" name="section_id">
                                <option value="">-- Select Section --</option>
                                @foreach ($sections as $sec)
                                <option value="{{ $sec->id }}">{{ $sec->name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="batch">Batch</label>
                            <select id="batch" class="form-control" name="batch_id">
                                <option value="">-- Select Batch --</option>
                                @foreach ($batches as $bat)
                                <option value="{{ $bat->id }}">{{ $bat->name }}</option>
                                @endforeach
                            </select>
                        </div>
<br>
                        <button class="btn btn-success">Upload Excel File</button>
                    </form>
                    <br>

                    <div class="col-md-8">
                        @if (Session::has('success'))
                        <div class="alert alert-success" role="alert">
                            {{ Session::get('success') }}
                        </div>
                        @endif
                    </div>
                    <br>

                    <div class="col-md-8">
                        @if (Session::has('import_errors'))
                        @foreach (Session::get('import_errors') as $failure)
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ $failure['message'] }} at line no {{ $failure['row'] }}
                        </div>
                        @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row mt-5 mx-5">
        <div class="col-md-8">
            <div class="card shadow mt-3">
                <div class="card-body">
                    <table class="table table-hover mt-3" id="example">
                        <thead>
                            <tr>
                                <th colspan="3">
                                    List Of Users
                                </th>
                            </tr>
                            <tr class="table-dark">
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if (count($users))
                            @foreach ($users as $user)
                            <tr>
                                <td>{{ $user->id }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    <a href="{{ url('studentedit', $user->id) }}" class="btn btn-primary">Edit</a>
                                    <a href="{{ url('studentdelete', $user->id) }}" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="3">No data found</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


</div>
@endsection
