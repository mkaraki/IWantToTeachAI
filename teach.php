<?php
require_once __DIR__ . '/req/getTeachConf.php';

$randSrcIndex = random_int(0, count($teachInfo['src']) - 1);

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
    <title>Teach - I Want To Teach</title>
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
    <div class="mb-3">
        <h1>I Want To Teach AI</h1>
    </div>
    <div class="mb-3">
        <?php switch ($teachInfo['type']):
            case 'audio': ?>
                <audio src="<?= $srvSrcPath ?>" controls></audio>
                <?php break; ?>
        <?php endswitch; ?>
    </div>
    <div>
        <form action="learn.php" method="POST">
            <input type="hidden" name="tid" value="<?= $tid ?>">
            <input type="hidden" name="src" value="<?= $randSrcIndex ?>">
            <div class="mb-3">
                <?php if (isset($teachInfo['instruction'])) : ?>
                    <label for="valueinput"><?= str_replace("\n", '<br />', htmlentities($teachInfo['instruction'])) ?></label>
                <?php endif; ?>
                <input type="text" class="form-control" name="value" id="valueinput">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" class="form-check-input" id="sendit" required>
                <label class="form-check-label" for="sendit">Prevent for wrong transmission</label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>
</body>

</html>