<?php
require __DIR__ . '/vendor/autoload.php';
session_start();

use Endroid\QrCode\Color\Color;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel;
use Endroid\QrCode\QrCode;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Writer\PdfWriter;
use Endroid\QrCode\Writer\WebPWriter;

if($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST['text'])) {
	$text = $_POST['text'];
	$output = $_POST['output'];
	$timestamp = date('Ymd_His');

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

	$qrcodeDir = 'qrcode/';

	if(!is_dir($qrcodeDir)) {
		mkdir($qrcodeDir, 0777, true);
	}

	switch ($output) {
		case 'show':
			$writer = new PngWriter();
			$result = $writer->write($qrCode);
			header('Content-Type: ' . $result->getMimeType());
			echo $result->getString();
			break;
		case 'pdf':
			$writer = new PdfWriter();
			break;
		case 'png':
			$writer = new PngWriter();
			$result = $writer->write($qrCode);
			$filename = $text . '_' . $timestamp . '.png';
			$result->saveToFile(__DIR__ . '/qrcode/' . $filename);
			$_SESSION['downloadFile'] = $filename;
			header("Location: index.php");
			exit;
			break;
		case 'webp':
			$writer = new WebPWriter();
			break;
		default:
			echo "failed";
			break;
	}
} else {
	echo "Teks tidak boleh kosong";
}