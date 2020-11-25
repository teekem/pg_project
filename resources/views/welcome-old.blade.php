@extends('layouts.app', [
  
    'class' => 'login-page sidebar-mini ',
   
    'backgroundImage' => asset('assets') . "/img/run1.jpg",
])

@section('content')
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-transparent  bg-primary  navbar-absolute" >
  <div class="container-fluid">
    <div class="navbar-wrapper">
    <a class="navbar-brand" href="#pablo">Welcome</a>
    </div>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-controls="navigation-index" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-bar navbar-kebab"></span>
      <span class="navbar-toggler-bar navbar-kebab"></span>
      <span class="navbar-toggler-bar navbar-kebab"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navigation">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a href="{{ route('login') }}" class="nav-link">
            <i class="now-ui-icons design_app"></i> {{ __("Dashboard") }}
          </a>
        </li>
        <li class="nav-item  active ">
          <a href="{{ route('register') }}" class="nav-link">
            <i class="now-ui-icons tech_mobile"></i> {{ __("Register") }}
          </a>
        </li>
        <li class="nav-item  active ">
          <a href="{{ route('student.login') }}" class="nav-link">
            <i class="now-ui-icons users_circle-08"></i> {{ __("Student Login") }}
          </a>
        </li>
        <li class="nav-item  active  ">
          <a href="{{ route('login') }}" id="aPortalAdmin" class="nav-link" target="_new">
            <i class="now-ui-icons users_circle-08"></i> {{ __("Admin Login") }}
          </a>
        </li>
       
      </ul>
    </div>
  </div>
</nav>
<!-- End Navbar -->
  <div class="content" style="margin-top: 100px">
    <div class="container">
      <div class="col-md-12 ml-auto mr-auto">
          <div class="header bg-gradient-primary py-10 py-lg-2 pt-lg-12">
              <div class="container">
                  <div class="header-body text-center mb-7">
                      <div class="row justify-content-center">
                          <div class="col-lg-12 col-md-9">
                              <h3 class="text-white">{{ __('Welcome to Redeemer\'s University, N0 1. University in Africa') }}</h3>
                              <h4 class="text-white" >Running with the vission ...</h4>
                              <p class="text-lead text-light mt-3 mb-0">
                              
                              </p>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>
      <div class="col-md-4 ml-auto mr-auto">
      </div>
    </div>
  </div>

<!-- 
@push('js')
  <script>
    $(document).ready(function() {
      demo.checkFullPageBackgroundImage();
    });
  </script>
@endpush -->

<footer class="footer">
  <div class=" container-fluid ">
    <nav>
      <ul>
        <li>
          <a href="https://www.run.edu.ng"  target="_blank">
            {{__(" About Us")}}
          </a>
        </li>
        <li>
          <a href="https://www.run.edu.ng"  target="_blank">
            {{__(" Blog")}}
          </a>
        </li>
      </ul>
    </nav>
    <div class="copyright" id="copyright">
      &copy;
      <!-- <script>
        document.getElementById('copyright').appendChild(document.createTextNode(new Date().getFullYear()))
      </script>, {{__(" Designed by")}} -->
      <a href="https://www.run.edu.ng" target="_blank">{{__(" Redeemer's University")}}</a>
  
    </div>
  </div>
</footer>

<script language="javascript" >
            $("#aPortalAdmin").click(function() {
               
                myWindow = window.open("<?php echo "http://localhost:8000/login"; ?>", "", "width=100, height=100");
                myWindow.resizeTo(250, 250);
                myWindow.focus();
                // alert("Proceed???");
            });

        </script>
@endsection