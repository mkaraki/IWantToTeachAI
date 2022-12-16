<?php
require_once __DIR__ . '/req/getTeachConf.php';
require_once __DIR__ . '/req/intr_viewsvc.php';

if (
    isset($teachInfo['userPassword']) &&
    (!isset($_SERVER['PHP_AUTH_PW']) ||
        $teachInfo['userPassword'] !== $_SERVER['PHP_AUTH_PW'])
) {
    header("WWW-Authenticate: Basic realm=\"Input provided password\"");
    http_response_code(401);
    die('Auth needed');
}

$randSrcIndex = random_int(0, count($teachInfo['src']) - 1);
if (
    isset($_GET['src']) &&
    is_numeric($_GET['src']) &&
    ($srcid = intval($_GET['src'])) >= 0
)
    $randSrcIndex = $srcid;
else if (isset($_GET['next']))
    $randSrcIndex = 0;


if (!isset($teachInfo['src'][$randSrcIndex])) {
    if (isset($_GET['next']))
        die('End of dataset');
    else
        die('Invalid learning information');
}

$srcPath = '/dataset/' . $tid . '/src/' . $teachInfo['src'][$randSrcIndex];
$actSrcPath = __DIR__ . $srcPath;
if (!is_file($actSrcPath))
    die('Invalid learning information');
$srvSrcPath = '/dataset/' . $tid . '/src/' . urlencode($teachInfo['src'][$randSrcIndex]);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Teach - <?= $teachInfo['title'] ?? 'Untitled Project' ?> - <?php $APPNAMEH ?></title>
    <link rel="stylesheet" href="/vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
</head>

<body class="p-3">
    <?php if (isset($_GET['done'])) : ?>
        <div class="mb-3">
            <div class="alert alert-success" role="alert">
                Success
            </div>
        </div>
    <?php endif; ?>
    <div class="mb-4">
        <h1 class="mb-0"><?= $teachInfo['title'] ?? 'Untitled Project' ?></h1>
        <p class="lead">Teach</p>
    </div>
    <div class="mb-3">
        <?php require __DIR__ . '/req/view_src.php'; ?>
    </div>
    <div>
        <form action="learn.php" method="POST">
            <input type="hidden" name="tid" value="<?= $tid ?>">
            <input type="hidden" name="src" value="<?= $randSrcIndex ?>">
            <?php if (isset($_GET['next'])) : ?>
                <input type="hidden" name="next" value="1">
            <?php endif; ?>
            <div class="mb-3">
                <?php if (isset($teachInfo['instruction'])) : ?>
                    <label for="valueinput"><?= str_replace("\n", '<br />', htmlentities($teachInfo['instruction'])) ?></label>
                <?php endif; ?>
                <?php if (isset($teachInfo['input'])) : ?>
                    <?php if ($teachInfo['input'] === 'multiline') : ?>
                        <textarea class="form-control" id="valueinput" rows="3" name="value" required></textarea>
                    <?php elseif (isset($teachInfo['inputVariation']) && $teachInfo['input'] === 'select') : ?>
                        <select name="value" class="form-select" name="value" required>
                            <?php foreach ($teachInfo['inputVariation'] as $i => $v) : ?>
                                <option value="<?= $i ?>"><?= htmlentities($v) ?></option>
                            <?php endforeach; ?>
                        </select>
                    <?php else : ?>
                        <input type="text" class="form-control" name="value" id="valueinput" required>
                    <?php endif; ?>
                <?php else : ?>
                    <input type="text" class="form-control" name="value" id="valueinput" required>
                <?php endif; ?>
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="sendit" required>
                <label class="form-check-label" for="sendit">Prevent for wrong transmission</label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <?php if (!isset($_GET['src'])) : ?>
                <button type="button" class="btn btn-danger" onclick="location.reload();">Skip</button>
            <?php elseif (isset($_GET['next'])) : ?>
                <a class="btn btn-danger" role="button" href="?tid=<?= $tid ?>&src=<?= $srcid + 1 ?>&next=1">Skip</a>
            <?php endif; ?>
        </form>
    </div>
</body>

</html>