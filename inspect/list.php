<?php
require_once __DIR__ . '/_list.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learned Data - <?= $teachInfo['title'] ?? 'Untitled Project' ?> - Teach AI</title>
    <link rel="stylesheet" href="../vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
</head>

<body class="p-3">
    <div class="mb-4">
        <h1 class="mb-0"><?= $teachInfo['title'] ?? 'Untitled Project' ?></h1>
        <p class="lead">Learned datas</p>
    </div>
    <div class="mb-3">
        <a class="btn btn-primary" href="listcsv.php?tid=<?= $_GET['tid'] ?><?= isset($_GET['src']) ? '&src=' . $_GET['src'] : '' ?>" role="button">
            Download csv
        </a>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">Source ID</th>
                <th scope="col">Source File Name</th>
                <th scope="col">Value</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($list as $i) : ?>
                <tr>
                    <td><?= $i['src'] ?></td>
                    <td>
                        <?= htmlentities($i['srcName']) ?>
                        <br />
                        <?php
                        if (isset($_GET['preview'])) {
                            $srvSrcPath = '/dataset/' . $tid . '/src/' . urlencode($i['srcName']);
                            require __DIR__ . '/../req/view_src.php';
                        }
                        ?>
                    </td>
                    <td>
                        <pre><?= htmlentities($i['value']) ?></pre>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>