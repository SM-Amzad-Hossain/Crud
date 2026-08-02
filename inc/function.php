<?php

define('DB_NAME', '/home/iqbal/Sites/Crud/data/db.txt');
function seed()
{
    $data = array(
        array(
            'id'    => 1,
            'fname' => 'Amzad',
            'lname' => 'Hossain',
            'roll'  => '1'

        ),
        array(
            'id'    => 2,
            'fname' => 'Al',
            'lname' => 'Hasib',
            'roll'  => '2'

        ),
        array(
            'id'    => 3,
            'fname' => 'Nurul',
            'lname' => 'Anam',
            'roll'  => '3'

        ),
        array(
            'id'    => 4,
            'fname' => 'Omor',
            'lname' => 'Faruk',
            'roll'  => '4'

        ),
        array(
            'id'    => 5,
            'fname' => 'Riyed',
            'lname' => 'Anam',
            'roll'  => '5'

        ),
        array(
            'id'    => 6,
            'fname' => 'Sabbir',
            'lname' => 'Hossain',
            'roll'  => '6',
        ),
    );
    $serializeData = serialize($data);
    file_put_contents(DB_NAME, $serializeData, LOCK_EX);
}

function generateReport()
{
    $serializedData = file_get_contents(DB_NAME);
    $students = unserialize($serializedData);
?>
    <table>
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Roll</th>
            <th>Action</th>
        </tr>
        <?php
        foreach ($students as $student) {
        ?>
            <td><?php printf('%d', $student['id']); ?></td>
            <td><?php printf('%s %s', $student['fname'], $student['lname']); ?></td>
            <td><?php printf('%s', $student['roll']); ?></td>
            <td><a href="edit.php?id=<?php printf('%d', $student['id']); ?>">Edit</a> | <a href="delete.php?id=<?php printf('%d', $student['id']); ?>">Delete</a></td>
            </tr>
        <?php
        }
        ?>
    </table>
<?php
}
function addStudent($fname, $lname, $roll)