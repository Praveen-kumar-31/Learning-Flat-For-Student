@extends('layout.app')
@section('title', 'Session')

@section('content')
<div class="mt-5 mx-5">
    <div class="col-md-10">
        <div class="p-4">
            <div class="p-2 grid-margin stretch-card">
                <div class="row">
                    <div class="col-md-10">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Department/Section</h4>
                            </div>
                            <div class="card-body">
                                <form class="" action="{{ url('secstore') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <select id="country-dropdown" class="form-control" name="department_id">
                                            <option value="">-- Select Department--</option>
                                            @foreach ($departments as $data)
                                            <option value="{{ $data->id }}">
                                                {{ $data->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <br>

                                    <div class="form-group">
                                        <label for="Section"></label>
                                        <input type="text" class="form-control" id="sectionname" name="name"
                                            placeholder="Section">
                                    </div>
                                    <br>
                                    <button type="submit" class="btn btn-primary me-2">Submit</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-10">
                    <table class="table table-hover mt-3" id="example">
                        <thead>
                            <tr>
                                <th colspan="4">List Of Departments and Sections</th>
                            </tr>
                            <tr>
                                <th>ID</th>
                                <th>Department</th>
                                <th>Section</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(count($sections))
                            @foreach($sections as $section)
                            <tr>
                                <td>{{ $section->id }}</td>
                                <td>{{ $section->department ? $section->department->name : 'N/A' }}</td>
                                <td>{{ $section->name }}</td>
                                <td>
                                    <a href="{{ url('section/edit', ['id' => $section->id]) }}" class="btn btn-primary btn-sm">Edit</a>
                                    <a href="{{ url('section/delete', ['id' => $section->id]) }}" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this section?')">Delete</a>
                                </td>
                            </tr>
                            @endforeach
                            @else
                            <tr>
                                <td colspan="4">No data found</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap5.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#example').DataTable();
                $('.alert .btn-close').on('click', function() {
                    $(this).closest('.alert').remove();
                });
            });
        </script>
    </div>
</div>
@endsection
