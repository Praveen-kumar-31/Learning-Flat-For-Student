<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<style>
    .login-box {    
       
        background: rgba(0,0,0,.5);       
    
      }
      body {
        
        font-family: sans-serif;
        
      }
      .cardheader {
       
        
        color: #fff;
        text-align: center;
      }
      .user-box input {
        width: 100%;
        padding: 10px 0;
        font-size: 16px;
        color: #fff;
        margin-bottom: 30px;
        border: none;
        border-bottom: 1px solid #fff;
        outline: none;
        background: transparent;
      }
      .user-box label {
       
        top:0;
        left: 0;
        padding: 10px 0;
        font-size: 16px;
        color: #fff;
        pointer-events: none;
        transition: .5s;
      }
</style>
</head>
<body>
<div class="container-fluid ">
    <div class="row d-flex justify-content-center align-items-center min-vh-100">
        <div class="col-lg-4">
            <div class="card shadow login-box ">
                <div class="card-header text-white cardheader">
                    <h2 class="">Register</h2>
                </div>
                <div class="card-body p-5">
                    <div id="show_success_alert"></div>
                    <form action="#" method="POST" id="register_form">
                        @csrf
                        <div class="mb-3 ">
                            <input type="text" name="name" id="name" class="form-control rounded-1"
                              placeholder="Name">
                               
                            <span class="text-danger error-text name_err"></span>
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <input type="email" name="email" id="email" class="form-control rounded-1"
                                placeholder="E-mail">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <input type="password" name="password" id="password" class="form-control rounded-1"
                                placeholder="Password">
                            <div class="invalid-feedback"></div>
                        </div>
                        <div class="mb-3">
                            <input type="password" name="cpassword" id="cpassword" class="form-control rounded-1"
                                placeholder="Confirm Password">
                            <div class="invalid-feedback"></div>
                        </div>

                        <div class="mb-3 d-grid">
                            <input type="submit" value="Register" class="btn btn-info rounded-1 " id="register_btn">
                        </div>
                        <div class="text-center ">
                            <div>
                                Already have an Account? <a href="/login" class="text-decoration none ">Login Here</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
    </body>
    </html>