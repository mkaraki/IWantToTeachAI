<?php
require_once __DIR__ . '/_list.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Learned datas</title>
    <link rel="stylesheet" href="../vendor/twbs/bootstrap/dist/css/bootstrap.min.css">
</head>

<body class="p-3">
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
                    <td><?= htmlentities($i['srcName']) ?></td>
                    <td>
                        <pre><?= htmlentities($i['value']) ?></pre>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>

</html>