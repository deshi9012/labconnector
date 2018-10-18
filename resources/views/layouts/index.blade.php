<!doctype html>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link rel="stylesheet" href="css/app.css">

	<title>Laravel</title>

</head>
<body>
<div id="app">
	<v-app>
		<Root> </Root>
	</v-app>
</div>
<script>
	window.App = <?= json_encode(['user' => auth()->user()]);?>;

</script>
<script src="js/app.js"></script>
</body>
</html>
