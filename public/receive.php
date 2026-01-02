<?php
$data = file_get_contents('php://input');

if (empty($data)) {
    header('HTTP/1.1 400 Bad Request');
    exit('No data received');
}

$udid = '';
$product = '';
$version = '';
$serial = '';

if (preg_match('/<\?xml.*<\/plist>/s', $data, $matches)) {
    $xml = $matches[0];
    
    if (preg_match('/<key>UDID<\/key>\s*<string>([^<]+)<\/string>/', $xml, $m)) {
        $udid = $m[1];
    }
    if (preg_match('/<key>PRODUCT<\/key>\s*<string>([^<]+)<\/string>/', $xml, $m)) {
        $product = $m[1];
    }
    if (preg_match('/<key>VERSION<\/key>\s*<string>([^<]+)<\/string>/', $xml, $m)) {
        $version = $m[1];
    }
    if (preg_match('/<key>SERIAL<\/key>\s*<string>([^<]+)<\/string>/', $xml, $m)) {
        $serial = $m[1];
    }
}

$params = http_build_query([
    'udid' => $udid,
    'product' => $product,
    'version' => $version,
    'serial' => $serial
]);

$host = $_SERVER['HTTP_HOST'];
header("Location: https://{$host}/result.php?{$params}");
exit;
