<?php

$people = '{"data":[{"first_name":"matt","last_name":"stauffer","age":31,"email":"matt@stauffer.com","secret":"VXNlIHRoaXMgc2VjcmV0IHBocmFzZSBzb21ld2hlcmUgaW4geW91ciBjb2RlJ3MgY29tbWVudHM="},{"first_name":"dan","last_name":"sheetz","age":99,"email": "dan@sheetz.com","secret":"YWxidXF1ZXJxdWUuIHNub3JrZWwu"}]}';
/**
 * Instructions:
 *
 * Given the above JSON, build a simple PHP script to import it.
 *
 * Your script should create two variables:
 *
 * - a comma-separated list of email addresses
 * - the original data, sorted by age descending, with a new field on each record
 *   called "name" which is the first and last name joined.
 * 
 * Please deliver your code in either a GitHub Gist or some other sort of web-hosted code snippet platform.
 */
 
function addFullName($person) {
    $person['name'] = getValue($person,'first_name')." ".getValue($person,'last_name');
    return $person;
}

function getValue($arr,$value,$default = '') {
    if (!empty($arr[$value])) {
        return $arr[$value];
    }
    return $default;
}
 
$people = json_decode($people,true);
$emails = [];
$arr = [];
 
foreach(getValue($people,'data',[]) as $person) {
    $emails[] = getValue($person,'email');
    $person = addFullName($person);
    $arr[] = $person;
}

usort($arr,function($a,$b){
    $age1 = getValue($a,'age',0);
    $age2 = getValue($b,'age',0);
    if ($age1 == $age2) {
        return 0;
    }
    return ($age1 > $age2) ? -1 : 1;
});

$newdata = ["data" => $arr];

var_dump(implode(',',$emails));

var_dump($newdata);

var_dump(json_encode($newdata));
