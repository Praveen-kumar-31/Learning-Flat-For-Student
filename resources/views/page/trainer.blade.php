@extends('layout.app')

@section('title', 'Trainer')

@section('content')
<div class="row d-flex justify-content-center align-items-center min-vh-100">
    <div class="col-md-8">
        <div class="p-4">
            <div class="p-2 grid-margin stretch-card">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Add Trainer</h4>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('trainerstore') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="trainername">Trainer Name</label>
                                <input type="text" class="form-control" id="trainername" name="name" placeholder="Enter Trainer...">
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
                    List Of Trainers
                </th>
            </tr>
            <tr>
                <th>ID</th>
                <th>Trainer Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @if(count($trainers) > 0)
            @foreach($trainers as $trainer)
            <tr>
                <td>{{ $trainer->id }}</td>
                <td>{{ $trainer->name }}</td>
                <td>
                    <a class="btn btn-outline-primary" href="{{ url('traineredit', $trainer->id) }}">Edit</a>
                    <a class="btn btn-outline-danger" href="{{ url('trainerdelete', $trainer->id) }}">Delete</a>
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
