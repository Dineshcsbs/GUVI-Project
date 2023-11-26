<?php
session_start();
if (isset($_SESSION['user_id'])) {
    $user_id =($_SESSION['user_id']) ;

    try {
        $conn = new MongoDB\Driver\Manager("mongodb://localhost:27017");
    } catch (MongoDB\Driver\Exception\Exception $e) {
        echo 'Failed to connect to MongoDB, is the service installed and running?<br /><br />';
        echo $e->getMessage();
        exit();
    }
    $filter = ['email' => $user_id];
    $query = new MongoDB\Driver\Query($filter);
    $cursor = $conn->executeQuery("userdatabase.usercollection", $query);

    if ($cursor) {
        echo '<h3>User Profile</h3>';
        echo '<style>
    label {
        font-size: 16px; /* Adjust the font size for labels */
    }

    input {
        width: 300px; /* Adjust the width for input fields */
        padding: 5px; /* Adjust padding for input fields */
        font-size: 14px; /* Adjust the font size for input fields */
    }

    button {
        font-size: 16px; /* Adjust the font size for the button */
        padding: 10px; /* Adjust padding for the button */
    }
    form {
        position: absolute;
        top: 20%;
        left: 50%;
        transform: translateX(-50%);
        width: 50%; /* You can adjust the width as needed */
        text-align: left; /* Align form contents to the left */
    }
</style>';
// echo '<title>User Profile</title>';
echo '<form method="post">'; // Assuming update_profile.php is the script to handle profile updates

foreach ($cursor as $rs) {
    echo '<label for="name">Name:</label><br>';
    echo '<input type="text" id="name" name="user" value="' . (isset($rs->user) ? $rs->user : '') . '" readonly><br><br>';

    echo '<label for="dob">DOB:</label><br>';
    echo '<input type="text" id="dob" name="dob" value="' . (isset($rs->dob) ? $rs->dob : '') . '" readonly><br><br>';

    echo '<label for="email">Email:</label><br>';
    echo '<input type="text" id="email" name="email" value="' . (isset($rs->email) ? $rs->email : '') . '" readonly><br><br>';

    echo '<label for="phone">Phone:</label><br>';
    echo '<input type="text" id="phone" name="phone" value="' . (isset($rs->phone) ? $rs->phone : '') . '" readonly><br><br>';
    
    echo '<label for="phone">Country:</label><br>';
    echo '<input type="text" id="phone" name="phone" value="' . (isset($rs->country) ? $rs->country: '') . '" readonly><br><br>';

}
echo'<form action="profile.html" method="post">
<button type="submit" name="updateProfile">Update Profile</button>
</form>';
if (isset($_POST['updateProfile'])) {
    // Redirect to profile.html
    header("Location: profile.html");
    exit(); // Make sure to exit to prevent further execution
}

echo '</form>';

        unset($query, $result);
    } else {
        echo "No data found in MongoDB for user ID: $user_id";
    }
} else {
    echo "You are not logged in";
}
 ?>
