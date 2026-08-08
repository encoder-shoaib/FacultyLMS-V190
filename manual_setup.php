<?php
$code = '7737791d-003b-43ed-abff-1e83d9bf39c6';
$script_url = 'http://127.0.0.1:8000';
$fields = [
    'domain'        => urlencode('127.0.0.1'),
    'version'       => '140', // 140 is typical based on previous code
    'item_id'       => '47989504',
    'url'           => urlencode($script_url),
    'purchase_code' => urlencode($code),
    'is_beta'       => 0,
];

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://desk.spagreen.net/verify-installation-v2');
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($fields));
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
$response = curl_exec($ch);
curl_close($ch);

$data = json_decode($response);

if ($data && property_exists($data, 'status') && $data->status) {
    echo "Verification successful. Downloading zip...\n";
    $zip_url = $data->release_zip_link;
    if ($zip_url) {
        $zip_path = __DIR__ . '/public/install/installer.zip';
        // Make sure directory exists
        if (!is_dir(dirname($zip_path))) {
            mkdir(dirname($zip_path), 0777, true);
        }
        file_put_contents($zip_path, file_get_contents($zip_url));
        echo "Downloaded zip to $zip_path\n";
        
        $zip = new ZipArchive;
        if ($zip->open($zip_path) === true) {
            $zip->extractTo(__DIR__ . '/');
            $zip->close();
            echo "Extracted zip successfully.\n";
            unlink($zip_path);
        } else {
            echo "Failed to extract zip.\n";
        }
    } else {
        echo "No zip link found in response.\n";
    }
} else {
    echo "Verification failed:\n";
    echo $response . "\n";
}
