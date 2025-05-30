<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>QR Code Generator</title>
</head>
<body>
	<h2>QR Code Generator</h2>
	<form action="generate.php" method="post">
		<label for="text">Teks atau URL</label><br>
		<input type="text" name="text" id="text" required><br><br>
		<button type="submit">Buat QR Code</button>
	</form>
</body>
</html>