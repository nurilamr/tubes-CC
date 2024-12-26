<?php
if (isset($_GET['file'])) {
    $file = urldecode($_GET['file']);
    $filepath = 'C:/xampp/htdocs/bengpro/teori/tubes/ijazah/' . $file;

    // Check if file exists
    if (file_exists($filepath)) {
        header('Content-Type: application/pdf');
        header('Content-Disposition: inline; filename="' . basename($filepath) . '"');
        header('Content-Transfer-Encoding: binary');
        header('Accept-Ranges: bytes');
        readfile($filepath);
    } else {
        echo "File does not exist.";
    }
} else {
    echo "No file specified.";
}
?>
