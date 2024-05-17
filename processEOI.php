<?php

require_once ("settings.php");

$conn = @mysqli_connect($host,
            $user,
            $pwd,
            $sql_db
);

if (!$conn) {
    echo "<p>Database connection failure</p>";
    }   else {
    
        $sql_table = "eoi";
    
        $jrnum = trim($_POST["JRnum"]);
        $firstName = trim($_POST["First-Name"]);
        $lastName = trim($_POST["Last-Name"]);
        $streetAddress = trim($_POST["street"]);
        $suburb = trim($_POST["suburb"]);
        $state = trim($_POST["state"]);
        $postCode = trim($_POST["postcode"]);
        $email = trim($_POST["email"]);
        $phoneNum = trim($_POST["phone"]);
        $skill1 = trim($_POST["skills1"]);
        $skill2 = trim($_POST["skills2"]);
        $skill3 = trim($_POST["skills3"]);
        $otherSkills = trim($_POST["otherSkills"]);

        if (empty($job_ref) || empty($first_name) || empty($last_name) || empty($date_of_birth) || empty($gender) || empty($phone) || empty($email) || empty($street) || empty($suburb) || empty($state) || empty($postcode)) {
            echo "<p>Error: All fields are required.</p>";
            exit();
          }

        
        // Validate input
        // preg_match(pattern, subject, matches, flags, offset)
        // used to search a string for a specific pattern and determine if the pattern exists
        // within the string. If the pattern is found, the function returns true; otherwise, it returns false.
    
        if (!preg_match("/^[A-Za-z0-9]{5}$/", $job_ref)) {
            echo "<p>Error: Invalid job reference number.</p>";
        }

        if (!preg_match("/^[A-Za-z]{1,20}$/", $first_name)) {
            echo "<p>Error: Invalid first name.</p>";
        }

        if (!preg_match("/^[A-Za-z]{1,20}$/", $last_name)) {
            echo "<p>Error: Invalid last name.</p>";
        }

        if (!preg_match("/^\d{2}\/\d{2}\/\d{4}$/", $date_of_birth)) {
            echo "<p>Error: Invalid date of birth format.</p>";
    
        }

        if (!in_array($gender, ['male', 'female', 'other'])) {
            echo "<p>Error: Invalid gender.</p>";
    
        }

        if (!preg_match("/^\d{8,12}$/", $phone)) {
            echo "<p>Error: Invalid phone number.</p>";
   
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<p>Error: Invalid email address.</p>";
    
        }

        if (!preg_match("/^[A-Za-z0-9\s]{5,40}$/", $street)) {
            echo "<p>Error: Invalid street address.</p>";

        }

        if (!preg_match("/^[A-Za-z\s]{5,40}$/", $suburb)) {
            echo "<p>Error: Invalid suburb/town.</p>";
        }

        if (!in_array($state, ['VIC', 'NSW', 'QLD', 'NT', 'WA', 'SA', 'TAS', 'ACT'])) {
            echo "<p>Error: Invalid state.</p>";
        }

        if (!preg_match("/^\d{4}$/", $postcode)) {
            echo "<p>Error: Invalid postcode.</p>";
        }

        // Create table if not exists
        $create_table_query = "
            EOInumber INT AUTO_INCREMENT PRIMARY KEY,
            JobReferenceNumber VARCHAR(255),
            FirstName VARCHAR(255),
            LastName VARCHAR(255),
            StreetAddress VARCHAR(255),
            SuburbTown VARCHAR(255),
            State VARCHAR(255),
            Postcode VARCHAR(255),
            EmailAddress VARCHAR(255),
            PhoneNumber VARCHAR(255),
            Skill1 VARCHAR(255),
            Skill2 VARCHAR(255),
            Skill3 VARCHAR(255),
            OtherSkills TEXT,
            Status ENUM('New', 'Current', 'Final') DEFAULT 'New'
)";
mysqli_query($conn, $create_table_query);


        $query = "insert into $sql_table (JobReferenceNumber, FirstName, LastName, StreetAddress, SuburbTown, State, Postcode, EmailAddress, PhoneNumber, Skill1, Skill2, Skill3, OtherSkills)
         values('$jrnum', '$firstName', '$lastName','$streetAddress','$suburb',
          '$state', '$postCode','$email','$phoneNum', '$skill1', '$skill2','$skill3', '$otherSkills')";
        
          $result = mysqli_query($conn, $query);

          if(!$result) {
              echo "<p>Error: Could not process your application.</p>";
          }   else {
              $EOInumber = mysqli_insert_id($conn);
              echo "<p>Thank you for your application. Your EOI number is: $EOInumber</p>";
          }
  
          mysqli_close($conn);
        }

?>