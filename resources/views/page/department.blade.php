@extends('layout.app')
@section('title', 'Dashboard')

@section('content')
<div class="row mt-5 mx-5">
 <div class="col-md-8">
    <div class="p-4">        
        <div class="p-2 grid-margin stretch-card">
            <div class="card">
                <div class="card-header"><h4 class="card-title"> Add Department</h4> </div>
                <div class="card-body">
                                     
                    <form class="" action="{{ url('store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="departmentname"></label>
                            <input type="text" class="form-control" id="departmentname" name="name" placeholder="Enter Department...">
                        </div>      <br>              
                        <button type="submit" class="btn btn-primary me-2">Submit</button>                    
                    </form>
                </div>
            </div>
        </div>
        <table class="table table-hover mt-3" id="example">
                <thead>
                    <tr>
                        <th colspan="3">
                            List Of Departments
                        </th>
                    </tr>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>   
                        <th>Action</th>                     
                    </tr>
                </thead>    
                <tbody>
                <tbody>
                    @if(count($departments))
                    @foreach($departments as $dept)
                        <tr>
                            <td>{{ $dept->id }}</td>
                            <td>{{ $dept->name }}</td>
                            <td>                                
                                <a class="btn btn-outline-primary" href="{{url('edit',$dept->id)}}">Edit</a>
                                <a class="btn btn-outline-danger" onclick="confirmation(ev)" href="{{url('delete',$dept->id)}}">Delete</a>    
                            </td>
                        </tr>
                    @endforeach
                    @else
                    <tr>
                        <td colspan="3">No data found</td>
                    </tr>
                    @endif
                </tbody>
                   
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
            $('#example1').DataTable();
            $('.alert .btn-close').on('click', function() {
                $(this).closest('.alert').remove();
            });
        });

        function confirmation(ev) {
        ev.preventDefault();
        var urlToRedirect = ev.currentTarget.getAttribute('href');  
        console.log(urlToRedirect); 
        swal({
            title: "Are you sure to Delete this post",
            text: "You will not be able to revert this!",
            icon: "warning",
            buttons: true,
            dangerMode: true,
        })
        .then((willCancel) => {
            if (willCancel) {


                 
                window.location.href = urlToRedirect;
               
            }  


        });

        
    }
    </script>    
</div>
</div>
@endsection