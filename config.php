<?php
// Get the server's document root
$documentRoot = $_SERVER['DOCUMENT_ROOT'];

// Get the script name's directory
$scriptDir = dirname($_SERVER['SCRIPT_NAME']);

// Create the base URL
$baseURL = 'http://' . $_SERVER['HTTP_HOST'] . $scriptDir;

// Ensure the base URL ends with a trailing slash
if (substr($baseURL, -1) != '/') {
    $baseURL .= '/';
}

// Output the base URL
echo "Base URL: " . $baseURL;
?>
