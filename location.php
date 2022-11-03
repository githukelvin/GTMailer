<?php
echo "<prev>";
$ip =$_SERVER['REMOTE_ADDR'];
print_r($_SERVER);
echo "<br>" ;
print_r($ip);
 
// To get  any host ip  addres  like  google ,facebook
echo "<br>" ;

echo gethostbyname('www.google.com');
echo "<br>" ;

echo "</prev>";


// GEOLOCATION

//https://ipwhois.app/json/ip_address



// getting  the real   location

$ipVal =  curl_init('https://ipwhois.app/json/json'.$ip);

curl_setopt($ipVal,CURLOPT_RETURNTRANSFER,true);

$json_VAlue= curl_exec($ipVal);
print_r($json_VAlue);
echo "<br>" ;
curl_close($ipVal);
$ResultIp = json_decode($json_VAlue,true);
echo "<br>" ;
print_r($ResultIp);
?>