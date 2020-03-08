<?php

function base64_to_jpeg($base64_string) {
    $data = explode( ',', $base64_string );
    if (count($data) > 1) {
        return base64_decode($data[1]);
    }

    return false;
}

function new_guid() {
    $s = strtoupper(md5(uniqid(mt_rand(),true)));
    return substr($s,0,8) . '-' .
        substr($s,8,4) . '-' .
        substr($s,12,4). '-' .
        substr($s,16,4). '-' .
        substr($s,20);
}
