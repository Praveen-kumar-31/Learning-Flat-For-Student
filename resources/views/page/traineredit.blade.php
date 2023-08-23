<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trainer Edit</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous"></script>

    <style>
        body {
            background-color: #F4F5F7;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="row my-5">
            <div class="col-lg-12">    
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Trainer Form</h4>                  
                        <form class="" action="{{ url('trainerupdate', ['id' => $trainers->id]) }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="trainername">Trainer Name</label>
                                <input type="text" class="form-control" id="trainername" name="name" placeholder="Enter trainer..." value="{{ $trainers->name }}">

                            </div>  
                            <br>                  
                            <button type="submit" class="btn btn-primary me-2">Submit</button>  
                            <a class="btn btn-primary me-2" href="{{ url('trainer') }}">Back</a>                  
                        </form>
                    </div>
                </div>
            </div>
        </div>        
    </div>
</body>
</html>
