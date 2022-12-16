<?php
require_once __DIR__ . '/_list.php';

if (isset($teachInfo['disableView']) && $teachInfo['disableView'] === true) {
    http_response_code(403);
    die('View disabled');
}

header('Content-Type: text/csv');

print('"Source Id","Source File Name","Value"');

foreach ($list as $i) {
    $escapedValue = str_replace('"', '""', $i['value']);
    $escapedSrc = str_replace('"', '""', $i['srcName']);
    print("\n" . '"' . $i['src'] . '","' . $escapedSrc . '","' . $escapedValue . '"');
}
