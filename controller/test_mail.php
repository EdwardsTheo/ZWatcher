<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>JavaScript Alert Box by PHP</title>

<?php 
// PHP program to pop an alert 
// message box on the screen 
  
// Function defnition 
function function_alert($message) { 
      
    // Display the alert box  
    echo "<script>alert('$message');</script>"; 
} 
  
  
// Function call 
function_alert($_SESSION['message']); 
  
?> 

</head>

<body>
</body>
</html>
