@extends('layouts.app', [
    'namePage' => 'Student Login ',
    'class' => 'login-page sidebar-mini ',
    'activePage' => 'studentLogin',
    'backgroundImage' => asset('assets') . "/img/run1.jpg",
])

@section('content')
    <div class="content">
        <div class="container">
        <div class="col-md-12 ml-auto mr-auto">
            <div class="header bg-gradient-primary py-10 py-lg-2 pt-lg-12">
                <div class="container">
                    <div class="header-body text-center mb-7">
                        <div class="row justify-content-center">
                            <div class="col-lg-12 col-md-9">
                                <p class="text-lead text-light mt-3 mb-0">
                                    
                                </p>
                            </div>
                            <div class="col-lg-5 col-md-6">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-4 ml-auto mr-auto">
            <form role="form" method="POST" action="{{ route('student.login') }}">
                @csrf
            <div class="card card-login card-plain">
                <div class="card-header ">
                <div class="logo-container">
                    <img src="{{ asset('assets/img/run1.jpg') }}" style="border-radius: 100px 100px 100px 100px" alt="">
                </div>
                
                </div>
                <div class="card-body ">
                    <h3 class="text-white" style="margin-left: 50px; padding-bottom: 0">Student Login</h3>
                <div class="input-group no-border form-control-lg {{ $errors->has('matric_no') ? '
                 has-danger' : '' }}">
                    <span class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="now-ui-icons users_circle-08"></i>
                    </div>
                    </span>
                    <input class="form-control {{ $errors->has('matric_no') ? ' is-invalid' : '' }}" 
                    placeholder="{{ __('Matric Number') }}" 
                    type="text" name="matric_no" value="{{ old('matric_no') }}" required autofocus>
                </div>
                @if ($errors->has('matric_no'))
                    <span class="invalid-feedback" style="display: block;" role="alert">
                    <strong>{{ $errors->first('matric_no') }}</strong>
                    </span>
                @endif


                <div class="input-group no-border form-control-lg {{ $errors->has('password') ? ' has-danger' : '' }}">
                    <div class="input-group-prepend">
                    <div class="input-group-text">
                        <i class="now-ui-icons objects_key-25"></i></i>
                    </div>
                    </div>
                    <input placeholder="Password" class="form-control {{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{ __('Password') }}" type="password" value="" required>
                </div>
                @if ($errors->has('password'))
                    <span class="invalid-feedback" style="display: block;" role="alert">
                    <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
                </div>
                
                <div class="card-footer ">
                <button  type = "submit" class="btn btn-primary btn-round btn-lg btn-block mb-3" style="background-color: gold">{{ __('Get Started') }}</button>
                <div class="pull-left">
                    <h6>
                    <a href="{{ route('index') }}" class="link footer-link">{{ __('back') }}</a>
                    </h6>
                </div>
                <div class="pull-right">
                    <h6>
                    <a href="{{ route('password.request') }}" class="link footer-link">{{ __('Forgot Password?') }}</a>
                    </h6>                
                </div>
                </div>
            </div>
            </form>
        </div>
        </div>
    </div>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
        demo.checkFullPageBackgroundImage();
        });
    </script>
@endpush
