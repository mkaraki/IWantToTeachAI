<?php
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../_config.php';
require_once __DIR__ . '/../req/getTeachConf.php';

if (
    isset($_GET['src']) &&
    is_numeric($_GET['src']) &&
    ($sid = intval($_GET['src'])) >= 0
)
    $dbRes = DB::query('SELECT src, val from learn WHERE tid=%i AND src=%i', $tid, $sid);
else
    $dbRes = DB::query('SELECT src, val from learn WHERE tid=%i', $tid);

$list = [];

foreach ($dbRes as $data) {
    $srcId = $data['src'];
    $list[] = array(
        'src' => $srcId,
        'srcName' => $teachInfo['src'][$srcId] ?? 'Unknown',
        'value' => $data['val'],
    );
}
