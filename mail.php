<?php
$to = "harendar.singh@sunarctechnologies.com";
$subject = "My subject";
$txt = "Hello world!";
$headers = "From: harendar.singh@sunarctechnologies.com" . "\r\n" .
"CC: harendar.singh@sunarctechnologies.com";

mail($to,$subject,$txt,$headers);
?>