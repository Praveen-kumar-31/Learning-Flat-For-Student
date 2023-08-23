<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
</head>
<body>
            <div class="p-4">        
        <div class="p-2 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Department Edit</h4>                  
                    <form class="" action="{{ route('dupdate', ['id' => $department->id]) }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="departmentname">Department Name</label>
                            <input type="text" class="form-control" id="departmentname" name="name" placeholder="Enter Department..." value="{{ $department->name }}">
                        </div>                    
                        <button type="submit" class="btn btn-primary me-2">Submit</button>                    
                    </form>
                </div>
            </div>
        </div>
    </div>     
</body>
