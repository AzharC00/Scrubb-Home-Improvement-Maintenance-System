<?php 

$server = "localhost";
$user = "root";
$pass = "";
$database = "scrubb";

//Function for SQL injection filter
function sanitizeInput($input) {
    // Remove leading/trailing whitespaces
    $sanitizedInput = trim($input);

    // Remove HTML tags
    $sanitizedInput = strip_tags($sanitizedInput);
    
    // Filter special characters
    $sanitizedInput = filter_var($sanitizedInput, FILTER_SANITIZE_SPECIAL_CHARS);
  
    // Escape single quotes
    $sanitizedInput = str_replace("'", "\'", $sanitizedInput);
  
    // Remove SQL comments
    $sanitizedInput = preg_replace("/(--|#).*/", "", $sanitizedInput);
  
    // Remove UNION keyword
    $sanitizedInput = str_ireplace("UNION", "", $sanitizedInput);
  
    // Remove common SQL injection phrases
    $sanitizedInput = str_ireplace(["SELECT", "INSERT", "UPDATE", "DELETE", "DROP"], "", $sanitizedInput);
  
    return $sanitizedInput;
  }

$conn = mysqli_connect($server, $user, $pass, $database);

if (!$conn) {
    die("<script>alert('Connection Failed.')</script>");
}

?>