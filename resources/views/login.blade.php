    
@extends('layouts.login')

@section('content')

<div class="splash-container">
    <div class="panel panel-default panel-border-color panel-border-color-primary">
        <div class="panel-heading">
<!--            <img src="assets/img/logo-xx.png" alt="logo" width="102" height="27" class="logo-img">
            -->
            <span class="splash-description">Please enter your user information.</span></div>
        <div class="panel-body">
            <form action="{{url('authenticateuser')}}" method="post">

                {{ csrf_field() }}

                <div class="form-group">
                    <input  type="email" name="username" placeholder="Username" autocomplete="off" class="form-control" required>
                </div>
                <div class="form-group">
                    <input id="password" type="password" name="password" placeholder="Password" class="form-control" required>
                </div>
                <div class="form-group row login-tools">
                    <div class="col-xs-6 login-remember">
                        <div class="be-checkbox">
                            <input type="checkbox" id="remember">
                            <label for="remember">Remember Me</label>
                        </div>
                    </div>
                    <div class="col-xs-6 login-forgot-password"><a href="#">Forgot Password?</a></div>
                </div>
                <div class="form-group login-submit">
                    <button data-dismiss="modal" type="submit" class="btn btn-primary btn-xl">Sign me in</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection