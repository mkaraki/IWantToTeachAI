<?php
if (
    !isset($_GET['tid']) ||
    !is_numeric($_GET['tid'])
) {
    die('Invalid learning information');
}

$tid = intval($_GET['tid']);
if ($tid < 1)
    die('Invalid learning information');

$basePath = realpath(__DIR__ . '/../dataset/' . $tid);
if (!is_dir($basePath))
    die('Invalid learning information');

$srcPath = $basePath . '/src';
if (!is_dir($srcPath))
    die('Invalid learning information');

$confPath = $basePath . '/config.php';
if (!is_file($confPath))
    die('Invalid learning information');

require_once $confPath;

if (
    !isset($teachInfo) ||
    !isset($teachInfo['type']) ||
    !isset($teachInfo['src']) ||
    count($teachInfo['src']) < 1
)
    die('Invalid learning information');
