<!DOCTYPE html>
<html lang="en-US">
	<head>
		<meta charset="utf-8">
	</head>
	<body>
		<h2>Восстановление пароля</h2>

		<div>
			Для сброса пароля перейдите по ссылке: {{ URL::to('password/reset', array($token)) }}.
		</div>
	</body>
</html>
