<?php

require_once "inc/function.php";
$info = '';
$task = $_GET['task'] ?? 'report';
$error = $_GET['error'] ?? '0';
if ('seed' == $task) {
    seed();
    $info = 'Data seeded successfully';
}
$fname = '';
$lname = '';
$roll = '';

if (isset($_POST['submit'])) {
    $fname = filter_input(INPUT_POST, 'fname', FILTER_SANITIZE_SPECIAL_CHARS);
    $lname = filter_input(INPUT_POST, 'lname', FILTER_SANITIZE_SPECIAL_CHARS);
    $roll = filter_input(INPUT_POST, 'roll', FILTER_SANITIZE_SPECIAL_CHARS);
    $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS);

    if ($id) {
        if ($fname != '' && $lname != '' && $roll != '') {
            $result = updateStudent($id, $fname, $lname, $roll);
            if ($result) {
                header('location: index.php?task=report');
                exit;
            } else {
                $error = '1';
            }
        }
    } else {
        if ($fname != '' && $lname != '' && $roll != '') {
            $result = addStudent($fname, $lname, $roll);
            if ($result) {
                header('location: index.php?task=report');
                exit;
            } else {
                $error = '1';
            }
        }
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
        <?php if ('1' == $error): ?>
            <div class="row">
                <div class="column column-60 column-offset-20">
                    <blockquote style="color:red;">Duplicate roll number. Please use a different roll number.</blockquote>
                </div>
            </div>
        <?php endif; ?>
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
                    <form action="" method="POST">
                        <label for="fname">First Name</label>
                        <input type="text" name="fname" id="fname" value="<?php echo htmlspecialchars($fname); ?>">
                        <label for="lname">Last Name</label>
                        <input type="text" name="lname" id="lname" value="<?php echo htmlspecialchars($lname); ?>">
                        <label for="roll">Roll</label>
                        <input type="text" name="roll" id="roll" value="<?php echo htmlspecialchars($roll); ?>">
                        <button type="submit" class="button-primary" value="Save" name="submit">Save</button>
                    </form>
                </div>
            </div>
        <?php endif; ?>
        <?php
        if ('edit' == $task):
            $id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
            if (!$id) {
                $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_SPECIAL_CHARS);
            }
            $student = getStudent((int)$id);
            if ($student):
        ?>
                <div class="row">
                    <div class="column column-60 column-offset-20">
                        <form action="index.php?task=edit&id=<?php echo $id; ?>" method="POST">
                            <input type="hidden" name="id" value="<?php echo $id; ?>">
                            <label for="fname">First Name</label>
                            <input type="text" name="fname" id="fname" value="<?php echo htmlspecialchars($student['fname']); ?>">
                            <label for="lname">Last Name</label>
                            <input type="text" name="lname" id="lname" value="<?php echo htmlspecialchars($student['lname']); ?>">
                            <label for="roll">Roll</label>
                            <input type="text" name="roll" id="roll" value="<?php echo htmlspecialchars($student['roll']); ?>">
                            <button type="submit" class="button-primary" name="submit">Update</button>
                        </form>
                    </div>
                </div>
        <?php endif;
        endif; ?>

            </div>
        </body>

        </html>