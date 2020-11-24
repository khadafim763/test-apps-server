<?php
$result = file_get_contents("https://console.wablas.com/api/send-message?token=HrtH41TP8L3OSI8ODRO135Xipd6kZkIxcTQZ2u70YyZdNk5YFTfxfSEiR7B4dgrs&phone=6282360062674&message=hello");

echo "<pre>";
print_r($result);

?>