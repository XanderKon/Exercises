<?php

/**
 * Change array element $num and [0] position
 *
 * @param array $arr (reference)
 * @param int   $num
 *
 * @return void
 *
 * @author Kondratenko Alexander (Xander)
 */
function array_swap(&$arr, $num)
{
    $tmp = $arr[0];
    $arr[0] = $arr[$num];
    $arr[$num] = $tmp;
}

// test data
$arr = [4, 5, 8, 9, 1, 7, 2];
$i = 1;

echo 'Inital ' . print_r($arr, TRUE) . "\n\r";

echo "Starting magic...Bang!\n\r\n\r";

while ($i < count($arr))
{
    foreach ($arr as $key => $_arr)
    {
        if ($_arr > $arr[0] && $key < count($arr) - $i + 1)
        {
            array_swap($arr, $key);
        }
    }

    array_swap($arr, count($arr) - $i);
    $i++;
}

echo 'Result ' . print_r($arr, TRUE) . "\n\r";