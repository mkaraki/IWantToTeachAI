<?php
require_once __DIR__ . '/req/getTeachConf.php';
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
    <div class="mb-4">
        <h1 class="mb-0"><?= $teachInfo['title'] ?? 'Untitled Project' ?></h1>
        <p class="lead">Portal</p>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12 col-md-6 mb-5">
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
            <div class="col-12 col-md-6 mb-5">
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
        </div>
    </div>
</body>

</html>