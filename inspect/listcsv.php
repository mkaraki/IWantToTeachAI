<?php
require_once __DIR__ . '/_list.php';

header('Content-Type: text/csv');

print('"Source Id","Source File Name","Value"');

foreach ($list as $i) {
    $escapedValue = str_replace('"', '""', $i['value']);
    $escapedSrc = str_replace('"', '""', $i['srcName']);
    print("\n" . '"' . $i['src'] . '","' . $escapedSrc . '","' . $escapedValue . '"');
}
