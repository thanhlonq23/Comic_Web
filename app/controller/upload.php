<?php
$targetDir = '/AAAAA';
echo $targetDir;
$targetFile = $targetDir . basename($_SERVER['HTTP_X_FILE_NAME']);

if (!file_exists($targetDir)) {
    mkdir($targetDir, 0777, true);
}

$incomingData = file_get_contents('php://input');

if ($incomingData !== false) {
    file_put_contents($targetFile, $incomingData, FILE_APPEND);

    echo 'Chunk uploaded successfully!';
} else {
    echo 'Error receiving chunk data.';
}
?>
