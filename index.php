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

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $sid = $_POST['sid'];
    $lName = $_POST['lname'];
    $fName = $_POST['fname'];
    $bDay = $_POST['bday'];
    $gpa = $_POST['gpa'];
    $advisor = $_POST['advisor'];

//    echo $sid . " " . $lName . " " . $fName . " " . $bDay . " " . $gpa . " " . $advisor;
    //1 define the query
    $sql = 'INSERT INTO student (sid, last, first, birthdate, gpa, advisor)
            VALUES (:sid, :lname, :fname, :bday, :gpa, :advisor)';

    // 2 Prepare the statement
    $statement = $dbh->prepare($sql);

    //3 bind the parameters
    $statement->bindParam(':sid', $sid);
    $statement->bindParam(':lname', $lName);
    $statement->bindParam(':fname', $fName);
    $statement->bindParam(':bday', $bDay);
    $statement->bindParam(':gpa', $gpa);
    $statement->bindParam(':advisor', $advisor);

    //4 execute the query
    $statement->execute();

    //5 (optional) process the results
    echo "<p>Student $sid was inserted successfully!</p>";
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
echo "</ol> <a href='student-form.html'>Add Student</a>";