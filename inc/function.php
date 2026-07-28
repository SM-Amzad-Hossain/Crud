<?php
function seed($filename)
{
    $data = array(
        array(
            'fname' => 'Amzad',
            'lname' => 'Hossain',
            'roll'  => '1'

        ),
        array(
            'fname' => 'Al',
            'lname' => 'Hasib',
            'roll'  => '2'

        ),
        array(
            'fname' => 'Nurul',
            'lname' => 'Anam',
            'roll'  => '3'

        ),
        array(
            'fname' => 'Omor',
            'lname' => 'Faruk',
            'roll'  => '4'

        ),
        array(
            'fname' => 'Riyed',
            'lname' => 'Anam',
            'roll'  => '5'

        ),
    );
}
$serializeData = serialize($data);
file_put_contents($filename, $serializeData, LOCK_EX);
