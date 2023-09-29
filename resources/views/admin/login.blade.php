@extends('admin.layout.auth')

@section('title')
    Login | Payroll System Admin
@endsection

@section('css')
    <style type="text/css">

    </style>
@endsection

@section('content')

    <div class="authentication-form mx-auto">
        <div class="logo-center">
            <h2><b>Payroll<font color="#f05138"> System</font></b></h2>
        </div>
        <h3>Sign In</h3>

        @if ($errors->any())
            <div class="alert bg-danger text-light alert-dismissible fade show" role="alert">
                @foreach ($errors->all() as $error)
                    <span>{{ $error }}</span>
                @endforeach
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <i class="ik ik-x"></i>
                </button>
            </div>
        @endif

        <form action="{{ $form_url }}" method="post">
            @method('POST')
            @csrf
            <div class="form-group">
                <input type="text" name="email" class="form-control" placeholder="Email" required="">
                <i class="ik ik-user"></i>
            </div>
            <div class="form-group"  >
                <input type="password" id='password' name="password" class="form-control" placeholder="Password"
                    required="">
                <i class="ik ik-lock"></i>
                <span  style='position:absolute; right:10px; margin-top:-29px;'>
                    <i  onclick="show_password()" id='eye' class="fa fa-eye-slash"></i>
                </span>
            </div>

         

            <!--<div class="row">
                <div class="col text-left">
                    <label class="custom-control custom-checkbox">
                        <input type="checkbox" class="custom-control-input" id="item_checkbox" name="remember_token"
                            value="option1">
                        <span class="custom-control-label">&nbsp;Remember Me</span>
                    </label>
                </div>
            </div>-->
            <div class="sign-btn text-center">
                <button class="btn btn-theme" type="submit">Sign In</button>
            </div>
        </form>
    </div>
@endsection

@push('js')
    <script type="text/javascript">
        function show_password() {
            var x = document.getElementById("password");
            var eye = document.getElementById('eye');
            if (x.type === "password") {
                x.type = "text";
                eye.classList='fa fa-eye'
            } else {
                x.type = "password";
                eye.classList ='fa fa-eye-slash'
            }
        }
    </script>
@endpush
