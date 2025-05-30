<?php
session_start();
$downloadFile = '';

if(isset($_SESSION['downloadFile'])) {
	$downloadFile = $_SESSION['downloadFile'];
	unset($_SESSION['downloadFile']);
}
?>
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
		<label for="text">Text or URL</label><br>
		<input type="text" name="text" id="text" required><br><br>

		<label for="output">Output</label>
		<select name="output" id="output">
			<option value="show">Direct Output</option>
			<option value="pdf">Save as PDF</option>
			<option value="png">Save as PNG</option>
			<option value="webp">Save as WebP</option>
		</select>
		<button type="submit">Generate QR Code</button>
	</form>

	<?php if($downloadFile): ?>
		<script>
			window.onload = function(){
				const link = document.createElement('a');
				link.href = 'qrcode/<?= $downloadFile ?>';
				link.download = '';
				document.body.appendChild(link);
				link.click();
				document.body.removeChild(link);
			}
		</script>
	<?php endif; ?>
</body>
</html>