<?php

$ticket = $_GET['ticket'];
require_once 'phpqrcode/qrlib.php'; // Include the Composer autoloader

$path = 'img/';

// Create a QR code instance
$qrCode = $path.time().'.png';
QRcode :: png($ticket, $qrCode, 'H', 5, 5);
echo '<div class="absolute top-1/2 left-1/2 transform -translate-x-1/2 -translate-y-1/2">';
    echo '<p>Please save this image to be presented on attending pharmacist.</p>';
    echo '<img src="'.$qrCode.'" alt="Reservation QR">';
echo '</div>';
echo '<button onclick="window.location.href=\'find-drugs.php\'">Done</button>';
?>
