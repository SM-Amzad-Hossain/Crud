<?php
require_once "inc/function.php";
$info = '';
$task = $_GET['task'] ?? 'report';
if ('seed' == $task) {
    seed();
    $info = 'Data seeded successfully';
}
if (isset($_POST['submit'])) {
    $fname = Filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_STRING);
    $lname = Filter_input(INPUT_POST, 'lname', FILTER_SANITIZE_STRING);
    $roll = Filter_input(INPUT_POST, 'roll', FILTER_SANITIZE_STRING);

    if ($fname != '' && $lname != '' && $roll != '') {
        addStudent($fname, $lname, $roll);
        header('location: index.php?task=report');
        exit;
    }
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
        <?php if ('add' == $task): ?>
            <div class="row">
                <div class="column column-60 column-offset-20">
                    <form action="index.php?task=add" method="POST">
                        <label for="fname">First Name</label>
                        <input type="text" name="fname" id="fname">
                        <label for="lname">Last Name</label>
                        <input type="text" name="lname" id="lname">
                        <label for="roll">Roll</label>
                        <input type="text" name="roll" id="roll">
                        <button type="submit" class="button-primary" value="Save" name="submit">Save</button>
                    </form>
                </div>
            </div>
        <?php endif; ?>

    </div>
</body>

</html>