<?php
require __DIR__ . '/vendor/autoload.php';

use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;

$writer = new PngWriter();

if($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['text'])) {
	$text = $_POST['text'];

	$qrCode = new QrCode(
		data: $text,
		encoding: new Encoding('UTF-8'),
		errorCorrectionLevel: ErrorCorrectionLevel::Low,
		size: 300,
		margin: 10,
		roundBlockSizeMode: RoundBlockSizeMode::Margin,
		foregroundColor: new Color(0,0,0),
		backgroundColor: new Color(255, 255, 255)
	);

	$logo = new Logo(
		path: __DIR__ . '/assets/faedah.png',
		resizeToWidth: 50,
		punchoutBackground: true
	);

	$label = new Label(
		text: 'Label',
		textColor: new Color(255, 0, 0)
	);

	$result = $writer->write($qrCode);	
	// $writer->validateResult($result, $text);

	header('Content-Type: ' . $result->getMimeType());
	echo $result->getString();
} else {
	echo "Teks tidak boleh kosong";
}