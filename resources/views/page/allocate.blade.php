@extends('layout.app')
@section('title', 'Allocate')

@section('content')
<div class="row d-flex justify-content-center align-items-center min-vh-100">
    <div class="col-md-10">
        <div class="p-4">
            <div class="p-2 grid-margin stretch-card">
                <div class="row">
                    <div class="col-md-10">
                        <div class="card">
                            <div class="card-header">
                                <h4 class="card-title">Allocate Trainer</h4>
                            </div>
                            <div class="card-body">
                            <form class="" action="{{ route('astore') }}" method="POST">
                                    @csrf
                                    <div class="form-group">
                                        <label for="batch"></label>
                                        <select id="batch-dropdown" class="form-control" name="batch_id">
                                            <option value="">-- Select Batch--</option>
                                            @foreach ($batchs as $data)
                                            <option value="{{ $data->id }}">
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
                                            <option value="{{ $data->id }}">
                                                {{ $data->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    

                                    <div class="form-group">
                                        <label for="Section"></label>
                                        <select id="section-dropdown" class="form-control" name="section_id">
                                            <option value="">-- Select Section--</option>
                                        </select>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="course"></label>
                                        <select id="course-dropdown" class="form-control" name="course_id">
                                            <option value="">-- Select Course--</option>
                                            @foreach ($courses as $data)
                                            <option value="{{ $data->id }}">
                                                {{ $data->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                    <label for="trainer"></label>
                                    <select id="trainer-dropdown1" class="form-control" name="trainer1_id">
                                        <option value="">-- Select Trainer 1--</option>
                                        @foreach ($trainers as $data)
                                        <option value="{{ $data->id }}">
                                            {{ $data->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="trainer"></label>
                                    <select id="trainer-dropdown2" class="form-control" name="trainer2_id">
                                        <option value="">-- Select Trainer 2--</option>
                                        @foreach ($trainers as $data)
                                        <option value="{{ $data->id }}">
                                            {{ $data->name }}
                                        </option>
                                        @endforeach
                                    </select>
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
            <th>Department</th>
            <th>Section</th>
            <th>Batch</th>
            <th>Course</th>
            <th>Trainer 1</th>
            <th>Trainer 2</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
                        @foreach ($allocation as $allocation)
                            <tr>
                                <td>{{ $allocation->department->name }}</td>
                                <td>{{ $allocation->section->name }}</td>
                                <td>{{ $allocation->batch->name }}</td>
                                <td>{{ $allocation->course->name }}</td>
                                <td>{{ $allocation->trainer1->name }}</td>
                                <td>{{ $allocation->trainer2->name }}</td>
                                <td>
                                    <a href="{{ route('aedit', $allocation->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                    <form action="{{ route('adelete', $allocation->id) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this allocation?')">Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
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

                // When department dropdown changes, update section dropdown options
                $('#department-dropdown').on('change', function() {
                    var departmentId = $(this).val();
                    if (departmentId) {
                        $.ajax({
                            url: '{{ url("get-sections") }}',
                            type: 'POST',
                            data: {
                                department_id: departmentId,
                                _token: '{{ csrf_token() }}'
                            },
                            dataType: 'json',
                            success: function(data) {
                                $('#section-dropdown').html('<option value="">-- Select Section--</option>');
                                if (data.sections) {
                                    $.each(data.sections, function(key, value) {
                                        $('#section-dropdown').append('<option value="' + value.id + '">' + value.name + '</option>');
                                    });
                                }
                            }
                        });
                    } else {
                        $('#section-dropdown').html('<option value="">-- Select Section--</option>');
                    }
                });

                // When Trainer 1 dropdown changes, update Trainer 2 dropdown options
                $('#trainer-dropdown1').on('change', function() {
                    var trainerId1 = $(this).val();
                    $('#trainer-dropdown2 option[value="' + trainerId1 + '"]').hide();
                });
            });
        </script>
    </div>
</div>
@endsection
