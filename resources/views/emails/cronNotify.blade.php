<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Notification from musicfunder.net!</h2>
		<div>
			Dear {{ $user_name }},		
			<p>Thank you for submitting your {{ $type }} to musicfunder.net!</p>
			<p>Unfortunately your {{ $type }} contains some words which does not meet out guideline.</p>
			<p>Please review and remove this and then resubmit your {{ $type }}, otherwise your {{ $type }} will be removed within 24Hr.</p>
			<p>Thank you again for submitting your {{ $type }} into our database.</p>
		</div>
		<div>Sincerely,<br>
		The MusicFunder.net Team
		</div>
	</body>
</html>