<?php

/**
 * @param $a - any array
 * @param $b - any array
 * @param bool $sort - To sort the returned array of duples
 * @return array - A sorted list of dupes between two arrays
 */
function findDuplicates($a, $b, $sort = true)
{
    $out = [];
    $vals = [];
    $combined = array_merge($a, $b);

    //Made one big array with the values as index and increment
    foreach($combined as $value)
    {
        $vals[$value]++;
    }

    foreach($vals as $key => $times)
    {
        //If Times is > 1 then it means we have a dupe
        if($times > 1)
        {
            $out[] = $key;
        }
    }
    if($sort) sort($out);
    return $out;
}

// Test the new function by making two arrays
$a = [];
$b = [];
for($i=0; $i<50; $i++)
{
    $a[] = mt_rand(0,1000);
    $b[] = mt_rand(0,1000);
}

// Call our new function and echo its results to the screen
echo print_r(findDuplicates($a, $b), true);