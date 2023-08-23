@extends('layout.app')
@section('content')
<div>
    <div class="col-md-12 p-4">        
        <div class="p-2 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Batch Form</h4>                  
                    <form class="" action="{{ route('bupdate', ['id' => $batch->id]) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="departmentname">Batch Name</label>
                            <input type="text" class="form-control" id="batchname" name="name" placeholder="Enter Batch..." value="{{$batch->name}}">
                        </div>                    
                        <button type="submit" class="btn btn-primary me-2">Submit</button>                    
                    </form>
                </div>
            </div>
        </div>
    <div>
</div>
@endsection