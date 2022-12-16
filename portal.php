<?php
require_once __DIR__ . '/req/getTeachConf.php';
require_once __DIR__ . '/vendor/autoload.php';
require_once __DIR__ . '/_config.php';

if (isset($teachInfo['disablePortal']) && $teachInfo['disablePortal'] === true) {
    http_response_code(403);
    die('Portal disabled');
}

$totalCounts = DB::queryFirstRow('SELECT count(id) AS c FROM learn WHERE tid=%i', $tid);
$pSrcCounts = count(DB::queryFirstColumn('SELECT src FROM learn WHERE tid=%i GROUP BY tid, src', $tid));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $teachInfo['title'] ?? 'Untitled Project' ?> - Teach AI</title>
    <link rel="stylesheet" href="/vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
</head>

<body class="p-3">
    <div class="container">
        <div class="row">
            <div class="mb-4">
                <h1 class="mb-0"><?= $teachInfo['title'] ?? 'Untitled Project' ?></h1>
                <p class="lead">Portal</p>
                <div class="lead">
                    <?= count($teachInfo['src']) ?> sources available.
                    Learned <?= $totalCounts['c'] ?> times.
                    <?= $pSrcCounts ?> labelled sources.
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-md-4 mb-5">
                <div class="mb-2">
                    <h2>Labelling</h2>
                </div>
                <form action="teach.php">
                    <input type="hidden" name="tid" value="<?= $tid ?>">
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="start-learn-next" name="next">
                        <label class="form-check-label" for="start-learn-next">Start labelling from 0</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Start</button>
                </form>
            </div>
            <?php if (!isset($teachInfo['disableView']) || $teachInfo['disableView'] !== true) : ?>
                <div class="col-12 col-md-4 mb-5">
                    <div class="mb-2">
                        <h2>Learned data</h2>
                    </div>
                    <form action="inspect/list.php">
                        <input type="hidden" name="tid" value="<?= $tid ?>">
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="list-with-preview" name="preview">
                            <label class="form-check-label" for="list-with-preview">Preview source content</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Check learned data</button>
                    </form>
                </div>
            <?php endif; ?>
            <?php if (!isset($teachInfo['disableSources']) || $teachInfo['disableSources'] !== true) : ?>
                <div class="col-12 col-md-4 mb-5">
                    <div class="mb-2">
                        <h2>Source List</h2>
                    </div>
                    <form action="inspect/sources.php">
                        <input type="hidden" name="tid" value="<?= $tid ?>">
                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="sources-with-preview" name="preview">
                            <label class="form-check-label" for="sources-with-preview">Preview source content</label>
                        </div>
                        <button type="submit" class="btn btn-primary">Check sources</button>
                    </form>
                </div>
            <?php endif; ?>
        </div>
    </div>
</body>

</html>