<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Congratulations!</h2>
		<div>
			Dear {{$user_name}},
		</div>
		<div>
			<p>Your account has been approved successfully! Please find below the password and link to activate your account:</p>
			<p>Login ID: <strong>{{ $login_id }} </strong></p>
			<p>Password: <strong>{{ $password }}</p>
			<p>Link to activate: <strong>
				<a href="{{ url('/auth/activate/'.$token ) }}">{{ url('/auth/activate/'. $token) }}</a></strong></p>
			
		</div>
		<br/>
		<div>Sincerely,<br/>
			The mfunder.net Team
		</div>
	</body>
</html>