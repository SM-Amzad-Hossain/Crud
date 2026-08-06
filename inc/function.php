<?php

define('DB_NAME', dirname(__DIR__) . DIRECTORY_SEPARATOR . 'data' . DIRECTORY_SEPARATOR . 'db.txt');

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
            <td><a href="index.php?task=edit&id=<?php printf('%d', $student['id']); ?>">Edit</a> | <a class="delete" href="index.php?task=delete&id=<?php printf('%d', $student['id']); ?>">Delete</a></td>
            </tr>
        <?php
        }
        ?>
    </table>
<?php
}
function addStudent(string $fname, string $lname, string $roll)
{
    $found = false;
    $serializedData = file_get_contents(DB_NAME);
    $students = unserialize($serializedData);
    foreach ($students as $student) {
        if ($student['roll'] == $roll) {
            $found = true;
            break;
        }
    }
    if (!$found) {
        $newID = getNewID($students);
        $student = array(
            'id'    => $newID,
            'fname' => $fname,
            'lname' => $lname,
            'roll'  => $roll
        );
        array_push($students, $student);
        $serializeData = serialize($students);
        file_put_contents(DB_NAME, $serializeData, LOCK_EX);
        return true;
    }
    return false;
}
function getStudent(int $id)
{
    $serializedData = file_get_contents(DB_NAME);
    $students = unserialize($serializedData);
    foreach ($students as $student) {
        if ($student['id'] == $id) {
            return $student;
        }
    }
    return false;
}

function updateStudent(int $id, string $fname, string $lname, string $roll)
{
    $found = false;
    $serializedData = file_get_contents(DB_NAME);
    $students = unserialize($serializedData);

    foreach ($students as $_student) {
        if ($_student['roll'] == $roll && $_student['id'] != $id) {
            $found = true;
            break;
        }
    }

    if (!$found) {
        foreach ($students as $key => $student) {
            if ($student['id'] == $id) {
                $students[$key]['fname'] = $fname;
                $students[$key]['lname'] = $lname;
                $students[$key]['roll'] = $roll;
                break;
            }
        }

        $serializeData = serialize($students);
        file_put_contents(DB_NAME, $serializeData, LOCK_EX);
        return true;
    }
    return false;
}

function deleteStudent(int $id)
{
    $serializedData = file_get_contents(DB_NAME);
    $students = unserialize($serializedData);
    unset($students[$id - 1]);
    $serializeData = serialize($students);
    file_put_contents(DB_NAME, $serializeData, LOCK_EX);
}

function printRaw()
{
    $serializedData = file_get_contents(DB_NAME);
    $students = unserialize($serializedData);
    print_r($students);
}

function getNewID(array $students): int
{
    $maxID = max(array_column($students, 'id'));
    return $maxID + 1;
}
