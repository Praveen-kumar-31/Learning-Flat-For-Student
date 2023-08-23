@extends('layout.app')
@section('content')
<div>
    <div class="col-md-12 p-4">        
        <div class="p-2 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Topic Form</h4>                  
                    <form class="" action="{{ url('tstore') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <div class="form-group mb-3">
                                <label for="course">Course</label>
                                <select id="course-dropdown" class="form-control" name="course_id">
                                    <option value="">-- Select course --</option>
                                    @foreach ($courses as $course)
                                    <option value="{{$course->id}}">
                                        {{$course->name}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                            <label for="topicname">Topic Name</label>
                            <input type="text" class="form-control" id="topicname" name="name" placeholder="Enter Topic...">
                        </div>                    
                        <button type="submit" class="btn btn-primary me-2">Submit</button>                    
                    </form>
                </div>
            </div>
        </div>
    
        
        <div class="card p-4">
            <table class="table table-hover mt-3 " id="example">
                        <thead>
                            <tr>
                                <th colspan="4">
                                    List Of Topic
                                </th>
                            </tr>
                            <tr>
                                <th>ID</th>
                                <th>Course_Name</th>  
                                <th>Topic_Name</th>
                                <th>Actions</th>                      
                            </tr>
                        </thead>    
                        <tbody>
                            @if($topics && count($topics) > 0)
                                @foreach($topics as $topic)
                                    <tr>
                                        <td>{{ $topic->id }}</td>
                                        <td>{{ $topic->course->name }}</td>
                                        <td>{{ $topic->name }}</td>                                
                                        <td>                                
                                        <a class="btn btn-outline-primary" href="{{url('tedit',$topic->id)}}">Edit</a>
                                        <a class="btn btn-outline-danger" href="{{url('tdelete',$topic->id)}}">Delete</a>    
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
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        } );
    </script>   
</div>
@endsection