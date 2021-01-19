<?php

function function_alert($message) { 
    echo '<script type="text/javascript"> alert("'.$message.'")</script>';
    unset($_SESSION['message']);
}
 
?>