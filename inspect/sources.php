<?php
require_once __DIR__ . '/../req/getTeachConf.php';
require_once __DIR__ . '/../vendor/autoload.php';
require_once __DIR__ . '/../_config.php';
require_once __DIR__ . '/../req/intr_viewsvc.php';

if (isset($teachInfo['disableSources']) && $teachInfo['disableSources'] === true) {
    http_response_code(403);
    die('Sources disabled');
}

$learneds = DB::queryFirstColumn('SELECT src FROM learn WHERE tid=%i GROUP BY src', $tid);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sources - <?= $teachInfo['title'] ?? 'Untitled Project' ?> - <?= $APPNAMEH ?></title>
    <link rel="stylesheet" href="/vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
</head>

<body>
    <div class="mb-4">
        <h1 class="mb-0"><?= $teachInfo['title'] ?? 'Untitled Project' ?></h1>
        <p class="lead">Sources</p>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Source ID</th>
                <th scope="col">Source File Name</th>
                <th scope="col">Learned</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($teachInfo['src'] as $i => $v) : ?>
                <tr>
                    <td><?= $i ?></td>
                    <td>
                        <?= htmlentities($v) ?>
                        <br />
                        <?php
                        if (isset($_GET['preview'])) {
                            $srvSrcPath = '/dataset/' . $tid . '/src/' . urlencode($v);
                            require __DIR__ . '/../req/view_src.php';
                        }
                        ?>
                    </td>
                    <td>
                        <?php if (in_array($i, $learneds)) : ?>
                            <a href="list.php?tid=<?= $tid ?>&src=<?= $i ?>">labels</a>
                        <?php else : ?>
                            <span class="text-danger">Not learned yet</span>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</body>

</html>