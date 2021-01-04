<?php

$to      = 'thomasparis56@gmail.com';
$subject = 'the subject';
$message = 'hello';
$headers = 'From: "ZWatcher"<noreply.zwatcher@gmail.com>';

mail($to, $subject, $message, $headers);

?>

