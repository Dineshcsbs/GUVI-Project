<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // MongoDB Insert
    try {
        $conn = new MongoDB\Driver\Manager("mongodb://localhost:27017");
    } catch (MongoDB\Driver\Exception\Exception $e) {
        echo 'Failed to connect to MongoDB, is the service installed and running?<br /><br />';
        echo $e->getMessage();
        exit();
    }
        $username = $_POST['username'];
        $country = $_POST['country'];
        $dob = $_POST['dob'];
        $email = $_POST['email'];
        $phone=$_POST['phone'];
    
        try {
            $conn = new MongoDB\Driver\Manager("mongodb://localhost:27017");
        } catch (MongoDB\Driver\Exception\Exception $e) {
            echo 'Failed to connect to MongoDB, is the service installed and running?<br /><br />';
            echo $e->getMessage();
            exit();
        }
        $user = [ 'user' => $username,'email'=>$email, 'country' => $country,'dob'=>$dob,'phone'=>$phone];
    
        $row = new MongoDB\Driver\BulkWrite();
        $row->insert($user);
        $conn->executeBulkWrite('userdatabase.usercollection', $row);
        echo 'Registration successful!';
    }   
 else {
    echo 'Invalid request';
}  
?>

