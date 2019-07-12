<?php
$access_token = 'a8nDiwfxr2lDf/osmR9amK3RNTLJksI+r2Vz1rhvNH1CvieP123FM5lrZegvVHkdVhSCoWnBKOE+p39JkjqZ3uE8y/sDA4zhrLeD7ALRmOWIl+Rb3DdB6pu5MiY7cDMEmS2RcDReKbhyjQD4KTs2VAdB04t89/1O/w1cDnyilFU=';

$url = 'https://api.line.me/v1/oauth/verify';

$headers = array('Authorization: Bearer ' . $access_token);

$ch = curl_init($url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
$result = curl_exec($ch);
curl_close($ch);

echo $result;
