@extends('layout.app')

@section('title', 'Course')

@section('content')
<div class="row d-flex justify-content-center align-items-center min-vh-100">
    <div class="col-md-8">
        <div class="p-4">
            <div class="p-2 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add Course</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('cstore') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="coursename">Course Name</label>
                                <input type="text" class="form-control" id="coursename" name="name" placeholder="Enter Course...">
                            </div>
                            <br>
                            <button type="submit" class="btn btn-primary me-2">Submit</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <table class="table table-hover mt-3" id="example">
        <thead>
            <tr>
                <th colspan="3">
                    List Of Courses
                </th>
            </tr>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if(count($courses) > 0)
            @foreach($courses as $course)
            <tr>
                <td>{{ $course->id }}</td>
                <td>{{ $course->name }}</td>
                <td>
                    <a class="btn btn-outline-primary" href="{{ url('cedit', $course->id) }}">Edit</a>
                    <a class="btn btn-outline-danger" href="{{ url('cdelete', $course->id) }}">Delete</a>
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
@endsection
