<!DOCTYPE html>
<!--
    
This is a starter template page. Use this page to start your new project from
scratch. This page gets rid of all links and provides the needed markup only.
-->
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta http-equiv="x-ua-compatible" content="ie=edge">

  <title>Run::|::PG</title>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="/css/app.css">
 <style>
           .login-container{
    margin-top: 5%;
    margin-bottom: 5%;
}
.login-form-1{
    padding: 5%;
    box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 9px 26px 0 rgba(0, 0, 0, 0.19);
}
.login-form-1 h3{
    text-align: center;
    color: #333;
}
.login-form-2{
    padding: 5%;
    background: #0062cc;
    box-shadow: 0 5px 8px 0 rgba(0, 0, 0, 0.2), 0 9px 26px 0 rgba(0, 0, 0, 0.19);
}
.login-form-2 h3{
    text-align: center;
    color: #fff;
}
.login-container form{
    padding: 10%;
}
.btnSubmit
{
    width: 50%;
    border-radius: 1rem;
    padding: 1.5%;
    border: none;
    cursor: pointer;
}
.login-form-1 .btnSubmit{
    font-weight: 600;
    color: #fff;
    background-color: #0062cc;
}
.login-form-2 .btnSubmit{
    font-weight: 600;
    color: #0062cc;
    background-color: #fff;
}
.login-form-2 .ForgetPwd{
    color: #fff;
    font-weight: 600;
    text-decoration: none;
}
.login-form-1 .ForgetPwd{
    color: #0062cc;
    font-weight: 600;
    text-decoration: none;
}

 </style>
</head>
<body class="hold-transition sidebar-mini">
<div class="wrapper" id="login">
  
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

  <ul class="nav nav-tabs">
  
    <li><a data-toggle="tab" href="#admin">Admin Login</a></li>
   
  </ul>

  <div class="tab-content">
 
    <div id="admin" class="tab-pane fade">
      <div class="col-md-6 login-form-2">
                    <h3>Admin Login</h3>
                    <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="form-group">
                            <input  placeholder="Your Email *" 
                            id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                             name="email" value="{{ old('email') }}" required autofocus />
                             
                             @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                        </div>


                        <div class="form-group">
                            <input id="password" type="password" 
                            class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                             name="password" required
                            placeholder="Your Password *"  />
                            @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                        </div>


                        <div class="form-group">
                            <input type="submit" class="btnSubmit" value="Login" />
                        </div>
                        <div class="form-group">
                            <a href="#" class="ForgetPwd">Forget Password?</a>
                        </div>
                    </form>
                </div>
	</div>
 
  </div>
</div>

</div>
</div>
</div>
</div>
<footer class="main-footer">
    <!-- To the right -->
    <div class="float-right d-none d-sm-inline">
      Running with a vision ......
    </div>
    <!-- Default to the left -->
    <strong>Copyright &copy; 2020 <a href="https://adminlte.io">run.edu.ng</a>.</strong> All rights reserved.
  </footer>
  
</div>
<!-- ./wrapper -->


<script src="/js/app.js"></script>


</body>
</html>