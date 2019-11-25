<!DOCTYPE html>
<head>
  <title>Reset Password</title>
  <link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <!------ Include the above in your HEAD tag ---------->

  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
  <style type="text/css">
    .form-gap {
    padding-top: 70px;
    }
  </style>
</head>
<body>
<div class="form-gap"></div>
<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="panel panel-default">
              <div class="panel-body">
                <div class="text-center">
                  <h3><i class="fa fa-lock fa-4x"></i></h3>
                  <h2 class="text-center">{{ __('Reset Password') }}</h2>
                  <div class="panel-body">

                    <form action="{{ route('password.update') }}" id="register-form" role="form" autocomplete="off" class="form" method="POST">
                      @csrf

                      <input type="hidden" name="token" value="{{ $token }}">

                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="glyphicon glyphicon-envelope color-blue"></i></span>
                          <input id="email" name="email" placeholder="email address" class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"  type="email" required autocomplete="email" autofocus>
                        </div>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>


                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                          <input id="password" name="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" value="{{ old('email') }}"  type="password" required autocomplete="new-password">
                        </div>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                      </div>


                      <div class="form-group">
                        <div class="input-group">
                          <span class="input-group-addon"><i class="fa fa-lock"></i></span>

                          <input id="password-confirm" name="password_confirmation" placeholder="Password" class="form-control" type="password" required autocomplete="new-password">
                        </div>
                      </div>

                      <div class="form-group">
                        <button type="submit" class="btn btn-lg btn-primary btn-block">
                            {{ __('Reset Password') }}
                        </button>
                      </div>

                    </form>
    
                  </div>
                </div>
              </div>
            </div>
          </div>
    </div>
</div>
</body>
</html>