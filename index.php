<?php


ini_set('display_errors', 1);
error_reporting(E_ALL);

echo "<h1>Student List</h1>";

require_once $_SERVER['DOCUMENT_ROOT'].'/../config.php';

try {
    // instantiate our PDO DB object
    $dbh = new PDO(DB_DSN, DB_USERNAME, DB_PASSWORD);
//    echo 'Connected to database!!';
}
catch (PDOException $e) {
    die ($e->getMessage()); // this prevents the code from continuing to execute
}




//1 define
$sql = "SELECT * FROM student";

//2 prepare statement
$statement = $dbh->prepare($sql);

//3 bind parameters N/A

//4 execute query
$statement->execute();

//5 (optional) process the results
$result = $statement->fetchAll(PDO::FETCH_ASSOC);
echo "<ol>";
foreach($result as $row){
    echo "<li>".$row['last'].", ".$row['first']."</li>";
}
echo "</ol>";
