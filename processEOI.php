<?php
  // 1. Check user clicked submit button on Login Form
  if(isset($_POST['Apply-btn'])){

  // 2. Call connection class: mysqli
  require("includes/setting.php");

$conn = mysqli_connect($host, $user, $pwd, $sql_db);



// 3. Test connection success or error: connect_error

if($conn->connect_error) {
  echo'<div class="alert alert-warning mt-3" role="alert">Connection Failed</div>';
  die();
} else {
  echo '<div class="alert alert-success mt-3" role="alert">Connection Successful</div>';
}
// 4. Collect & store the POST data 
        $jrnum = isset($_POST["JRnum"]);
        $firstName = isset($_POST["First-Name"]);
        $lastName = isset($_POST["Last-Name"]);
        $date_of_birth = isset($_POST["date"]);
        $gender = isset($_POST["Gender"]);
        $phoneNum = isset($_POST["phone"]);
        $email = isset($_POST["email"]);

        $streetAddress = isset($_POST["street"]);
        $suburb = isset($_POST["suburb"]);
        $state = isset($_POST["state"]);
        $postCode = isset($_POST["postcode"]);

        $skill1 = isset($_POST["skills1"]);
        $skill2 = isset($_POST["skills2"]);
        $skill3 = isset($_POST["skills3"]);
        $skill4 = isset($_POST["skills4"]);
        $otherSkills = isset($_POST["otherSkills"]);

 // 5. Check to see if fields are  blank

        if (empty($jrnum) || empty($firstName) || empty($lastName) || empty($date_of_birth)|| empty($gender)|| empty ($phoneNum) || empty($email) || empty($streetAddress)|| empty($suburb) || empty($state) || empty($postCode) ) {
            header("Location: ../apply.php?error=emptyfeilds");
                echo "<p>Error: All fields are required.</p>";
            exit();
        }
    
    // Validate input
    // preg_match(pattern, subject, matches, flags, offset)
    // used to search a string for a specific pattern and determine if the pattern exists
    // within the string. If the pattern is found, the function returns tr

    if (!preg_match("/^[A-Za-z0-9]{5}$/", $jrnum)) {
        header("Location: ../apply.php?error=invalidJRnum");
            echo "<p>Error: Invalid job reference number.</p>";
        exit();
    }
    if (!preg_match("/^[A-Za-z]{1,20}$/", $firstName)) {
        header("Location: ../apply.php?error=invalidFirst-Name");
            echo "<p>Error: Invalid first name.</p>";
        exit();
    }

    if (!preg_match("/^[A-Za-z]{1,20}$/", $lastName)) {
        header("Location: ../apply.php?error=invalidLast-Name");
        echo "<p>Error: Invalid last name.</p>";
        exit();
    }

    if (!preg_match("/^\d{2}\/\d{2}\/\d{4}$/", $date_of_birth)) {
        header("Location: ../apply.php?error=invaliddate");
            echo "<p>Error: Invalid date of birth format.</p>";
        exit();

    }
    $validGenders = array("Male", "Female", "Other");
    if (!in_array($gender, $validGenders)) {
        $errors[] = "Please select a valid gender.";
    }


    if (!preg_match("/^\d{8,12}$/", $phoneNum)) {
        header("Location: ../apply.php?error=invalidphone");
            echo "<p>Error: Invalid phone number.</p>";

    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../apply.php?error=invaliduid&mail=" .$email);
            echo "<p>Error: Invalid email address.</p>";
        exit();
    }

    if (!preg_match("/^[A-Za-z0-9\s]{5,40}$/", $streetAddress)) {
        header("Location: ../apply.php?error=invalidstreet=" );
            echo "<p>Error: Invalid street address.</p>";
        exit();

    }

    if (!preg_match("/^[A-Za-z\s]{5,40}$/", $suburb)) {
        header("Location: ../apply.php?error=invalidsuburb");
            echo "<p>Error: Invalid suburb/town.</p>";
        exit();
    }

    if (!in_array($state, ['VIC', 'NSW', 'QLD', 'NT', 'WA', 'SA', 'TAS', 'ACT'])) {
        header("Location: ../apply.php?error=invalidstate=" );
            echo "<p>Error: Invalid state.</p>";
        exit();
    }

    if (!preg_match("/^\d{4}$/", $postCode)) {
        header("Location: ../apply.php?error=invalidpostcode=" );
            echo "<p>Error: Invalid postcode.</p>";
    }

  // 1. Prepare Stament
  $sql = "insert into applicant (JobReferenceNumber, FirstName, LastName, StreetAddress, SuburbTown, State, Postcode, EmailAddress, PhoneNumber, Skill1, Skill2, Skill3, Skill4, OtherSkills)
  values('$jrnum', '$firstName', '$lastName','$streetAddress','$suburb',
   '$state', '$postCode','$email','$phoneNum', '$skill1', '$skill2','$skill3', '$skill4', '$otherSkills')";
 
   $result = mysqli_query($conn, $sql);

   if(!$result) {
    echo "<p>Error: Could not process your application.</p>";
}   else {
    $EOInumber = mysqli_insert_id($conn);
    // Assume Success/ Redrict On Success   

        header("Location: ../apply.php?post=success"); 
        exit();
    echo "<p>Thank you for your application. Your EOI number is: $EOInumber</p>";
}





}