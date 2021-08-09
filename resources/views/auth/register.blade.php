<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'CapitalTicketing') }}</title>

    <!---Font Awesome-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />


<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="{{ asset('storage/images/icons/favicon.ico') }}"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('auth/vendor/bootstrap/css/bootstrap.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('auth/fonts/font-awesome-4.7.0/css/font-awesome.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('auth/fonts/Linearicons-Free-v1.0.0/icon-font.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('auth/vendor/animate/animate.css') }}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{ asset('auth/vendor/css-hamburgers/hamburgers.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('auth/vendor/animsition/css/animsition.min.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('auth/vendor/select2/select2.min.css') }}">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="{{ asset('auth/vendor/daterangepicker/daterangepicker.css') }}">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="{{ asset('auth/css/util.css') }}">
	<link rel="stylesheet" type="text/css" href="{{ asset('auth/css/main.css') }}">
<!--===============================================================================================-->

<script src="{{ asset('js/app.js') }}" defer></script>

<!-- Fonts -->
<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

<!-- Styles -->
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('{{ asset('storage/images/bg-01.jpg') }}');">
			<div class="wrap-login100 p-t-30 p-b-50">
				<span class="login100-form-title p-b-41">
					Account Register
				</span>
				<form class="login100-form validate-form p-b-33 p-t-5" enctype="multipart/form-data" method='POST' action="{{ route('register') }}">
                    @csrf


                    <div class="wrap-input100 validate-input" data-validate = "Enter firstname">
                        <input id="firstname" type="text" class="input100 @error('firstname') is-invalid @enderror" name="firstname" placeholder="First name" value="{{ old('firstname') }}" required autocomplete="firstname" autofocus>
                        <span class="focus-input100" data-placeholder="&#xe82a;"></span>
						@error('firstname')
							<span class="invalid-feedback input100" role="alert">
								<strong style="color: red;margin-left: -20px;">{{ $message }}</strong>
							</span>
                        @enderror
                    </div>

                    <div class="wrap-input100 validate-input" data-validate = "Enter lastname">
						<input id="lastname" class="input100 @error('lastname') is-invalid @enderror" type="text" name="lastname" placeholder="Last name" value="{{ old('lastname') }}" required autocomplete="lastname" autofocus>
						<span class="focus-input100" data-placeholder="&#xe82a;"></span>
						@error('lastname')
							<span class="invalid-feedback input100" role="alert">
								<strong style="color: red;margin-left: -20px;">{{ $message }}</strong>
							</span>
                        @enderror
					</div>

                    <div class="wrap-input100 validate-input" data-validate = "Enter username">
						<input id="username" class="input100 @error('username') is-invalid @enderror" type="text" name="username" placeholder="User name" value="{{ old('username') }}" required autocomplete="username" autofocus>
						<span class="focus-input100" data-placeholder="&#xe82a;"></span>
						@error('username')
							<span class="invalid-feedback input100" role="alert">
								<strong style="color: red;margin-left: -20px;">{{ $message }}</strong>
							</span>
                        @enderror
					</div>

                    <div class="wrap-input100 validate-input" data-validate = "Enter email">
						<input id="email" class="input100 @error('email') is-invalid @enderror" type="email" name="email" placeholder="Email" value="{{ old('email') }}" required autocomplete="email" autofocus>
						<span class="focus-input100" data-placeholder="&#xe818;"></span>
						@error('email')
							<span class="invalid-feedback input100" role="alert">
								<strong style="color: red;margin-left: -20px;">{{ $message }}</strong>
							</span>
                        @enderror
					</div>

                    <div class="wrap-input100 validate-input" data-validate = "Account Type">
						<select onchange="yesnoCheck(this)" name="account_type" class="input100 @error('account_type') is-invalid @enderror" id="" style="border:none !important; outline:none !important;">
							<option value="" selected disabled>Select Account Type</option>
							<option value="1">User</option>
							<option value="2">Agent</option>
						</select>
						<span class="focus-input100" data-placeholder="&#xe82a;"></span>
						@error('account_type')
							<span class="invalid-feedback input100" role="alert">
								<strong style="color: red;margin-left: -20px;">{{ $message }}</strong>
							</span>
                        @enderror
					</div>

					 <div class="wrap-input100 " id="ifVerification" style="display: none;">
						<input class="input100 " type="file" name="verification" >
						<span class="focus-input100" data-placeholder="&#xe82a;"></span>
					</div>


					<div class="wrap-input100 validate-input" data-validate="Enter password">
						<input id="password" min="8" class="input100 @error('password') is-invalid @enderror" type="password" name="password" placeholder="Password" required>
						<span class="focus-input100" data-placeholder="&#xe80f;"></span>
						@error('password')
							<span class="invalid-feedback input100" role="alert">
								<strong style="color: red;margin-left: -20px;">{{ $message }}</strong>
							</span>
                        @enderror
					</div>
					<div class="wrap-input100 validate-input" data-validate="Confirm password">
						<input id="password-confirm" class="input100" type="password" name="password_confirmation" placeholder="password_confirmation" required>
						<span class="focus-input100" data-placeholder="&#xe80f;"></span>
					</div>

					<div class="container-login100-form-btn m-t-32">
						<button class="login100-form-btn" type="submit">
							Register
						</button>
					</div>
                    <div class="container mt-3">
                        <div class="row">
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <a href="/"><i class="fas fa-home"></i>  Go Home</a>
                            </div>
                            <div class="col-md-6 col-sm-6 col-xs-6">
                                <a href="{{ route('login') }}">Already have an account ?</a>
                            </div> 
                        </div>
                    </div>
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>

	<script>
		const yesnoCheck = that => {
			if(that.value === "2"){
				document.getElementById("ifVerification").style.display = "block";
				alert('Upload a valid ID(Drivers license, International Passport or National Identification)')
			}
			else{
				document.getElementById("ifVerification").style.display = "none";
			}
		}
	</script>
	
<!--===============================================================================================-->
	<script src="{{ asset('auth/vendor/jquery/jquery-3.2.1.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('auth/vendor/animsition/js/animsition.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('auth/vendor/bootstrap/js/popper.js') }}"></script>
	<script src="{{ asset('auth/vendor/bootstrap/js/bootstrap.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('auth/vendor/select2/select2.min.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('auth/vendor/daterangepicker/moment.min.js') }}"></script>
	<script src="{{ asset('auth/vendor/daterangepicker/daterangepicker.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('auth/vendor/countdowntime/countdowntime.js') }}"></script>
<!--===============================================================================================-->
	<script src="{{ asset('auth/js/main.js') }}"></script>

</body>
</html>