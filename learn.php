<?php
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/_config.php';
require_once __DIR__ . '/req/getTeachConf.php';

if (
    isset($teachInfo['userPassword']) &&
    (!isset($_SERVER['PHP_AUTH_PW']) ||
        $teachInfo['userPassword'] !== $_SERVER['PHP_AUTH_PW'])
) {
    header("WWW-Authenticate: Basic realm=\"Input provided password\"");
    http_response_code(401);
    die('Auth needed');
}

if (
    !isset($_POST['tid']) ||
    !is_numeric($_POST['tid']) ||
    !isset($_POST['src']) ||
    !is_numeric($_POST['src']) ||
    !isset($_POST['value'])
) {
    var_dump($POST);
    die('Invalid learning information');
}

$tid = intval($_POST['tid']);
if ($tid < 1)
    die('Invalid learning information');

$sid = intval($_POST['src']);
if ($sid < 0)
    die('Invalid learning information');

if (!isset($teachInfo['dry']) && $teachInfo['dry'] !== true)
    DB::insert('learn', array(
        'tid' => $tid,
        'src' => $sid,
        'val' => $_POST['value'],
    ));

header(
    "Location: " .
        (empty($_SERVER['https']) ? 'http' : 'https') . "://" . $_SERVER['HTTP_HOST'] .
        '/teach.php?done=1&tid=' . $tid .
        (isset($_POST['next']) ? ('&next=1&src=' . ($sid + 1)) : ''),
    false,
    303
);
