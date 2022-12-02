<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/_config.php';

var_dump($_POST);

if (
    !isset($_POST['tid']) ||
    !is_numeric($_POST['tid']) ||
    !isset($_POST['src']) ||
    !is_numeric($_POST['src']) ||
    !isset($_POST['value'])
) {
    die('Invalid learning information');
}

$tid = intval($_POST['tid']);
if ($tid < 1)
    die('Invalid learning information');

$sid = intval($_POST['src']);
if ($sid < 0)
    die('Invalid learning information');

DB::insert('learn', array(
    'tid' => $tid,
    'src' => $sid,
    'val' => $_POST['value'],
));

header("Location: " . (empty($_SERVER['https']) ? 'http' : 'https') . "://" . $_SERVER['HTTP_HOST'] . '/teach.php?done=1&tid=' . $tid, false, 303);
