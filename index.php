<?php
require_once "inc/function.php";
$info = '';
$task = $_GET['task'] ?? 'report';
if ('seed' == $task) {
    seed();
    $info = 'Data seeded successfully';
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crud</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:300,300italic,700,700italic">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/milligram/1.4.1/milligram.css">
</head>

<body>
    <div class="continer">
        <div class="row">
            <div class="column column-60 column-offset-20">
                <h2>Crud</h2>
                <p>A sample Project to perfrom CRUD operations using plain files and PHP</p>
                <?php include_once('inc/templates/nav.php'); ?>
                <hr>
                <?php
                if ($info != '') {
                    echo "<p>{$info}</p>";
                }
                ?>
            </div>
        </div>
        <?php if ('report' == $task): ?>
            <div class="row">
                <div class="column column-60 column-offset-20">
                    <?php generateReport(); ?>
                </div>
            </div>
        <?php endif; ?>
    </div>
</body>

</html>