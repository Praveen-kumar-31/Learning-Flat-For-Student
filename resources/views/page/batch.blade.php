@extends('layout.app')
@section('content')
<div>
    <div class="row"></div>
    <div class="col-md-8 p-4">        
        <div class="p-2 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Batch Form</h4>                  
                    <form class="" action="{{ url('batchstore') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="departmentname">Batch Name</label>
                            <input type="text" class="form-control" id="batchname" name="name" placeholder="Enter Batch...">
                        </div>                    
                        <button type="submit" class="btn btn-primary me-2">Submit</button>                    
                    </form>
                </div>
            </div>
        </div>
        
        <div class="row mt-5 mx-1">
            <div class="col-md-12">
                <div class="card shadow mt-3">
                    <div class="card-body"> 
                        <table class="table table-hover mt-3" id="example">
                                <thead>
                                    <tr>
                                        <th colspan="3">
                                            List Of Batch
                                        </th>
                                    </tr>
                                    <tr>
                                        <th>ID</th>
                                        <th>Name</th> 
                                        <th>Action</th>                       
                                    </tr>
                                </thead>  
                                <tbody>
                                    @if(count($batches))
                                    @foreach($batches as $batch)
                                        <tr>
                                            <td>{{ $batch->id }}</td>
                                            <td>{{ $batch->name }}</td>
                                            <td>                                
                                                        <a class="btn btn-outline-primary" href="{{url('bedit',$batch->id)}}">Edit</a>
                                                        <a class="btn btn-outline-danger" href="{{url('bdelete',$batch->id)}}">Delete</a>    
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
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.4.1/js/responsive.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        } );
    </script>   
</div>
@endsection