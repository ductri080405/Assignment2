<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>About</title>
  <meta name="description" content="cutting-edge IT solutions to businesses of all sizes" />
  <meta name="author" content="Thupten" />
  <link rel="icon" type="image/png" href="./src/TechNova.png" />
  <link rel="stylesheet" href="./style.css">
</head>

<?php require "includes/header.inc"; 
include ("includes/settings.php");
$conn = @mysqli_connect($host, $user, $pwd, $sql_db);

if (!$conn) {
  echo "<p>Database connection failure</p>";
}  
?>

<main class="Apply-container">
  <section class="JobApply">
    <figure class="Job-Banner">
      <img src="./src/image/join.png" alt="Picture that says we are hiring">
    </figure>
    <h1 class="ApplicationHeader">Employment Application</h1>
    <p>Fill the form below accurately indicating your potentials and suitability to job applying for.</p>
    <hr>
    <form action="processEOI.php" method="post" novalidate="novalidate">
      <fieldset>
        <legend>Personal Details</legend>
        <label for="JRnum" class="Textlabel">Job reference number</label>
        <input type="text" name="JRnum" id="JRnum" required pattern="[A-Za-z0-9]{5}">



        <label for="First-Name" class="Textlabel">First Name:</label>
        <input type="text" name="First-Name" id="First-Name" required pattern="[A-Za-z]{5,20}">
        <label for="Last-Name" class="Textlabel">Last Name:</label>
        <input type="text" name="Last-Name" id="Last-Name" required pattern="[A-Za-z]{4,20}">

        <label for="date" class="Textlabel"> Birth Date</label>
        <input type="text" name="date" id="date" placeholder="dd/mm/yyyy" pattern="\d{2}\/\d{2}\/\d{4}">

        <!-- <input type="date" id="Date-Of-Birth" name="Date-Of-Birth" required="required" style="width: 40%;"> -->
        <br><br>
        <label for="male" class="Textlabel">Male</label>
        <input type="radio" id="male" name="Gender">
        <label for="female" class="Textlabel">Female</label>
        <input type="radio" id="female" name="Gender">
        <label for="other" class="Textlabel">Other</label>
        <input type="radio" id="other" name="Gender">
      </fieldset>

      <br><br>
      <label for="phone" class="Textlabel">Phone number</label>
      <input type="text" name="phone" id="phone" required="required" pattern="\d{8,12}">
      <br><br>
      <label for="email" class="Textlabel">Email address</label>
      <input type="text" name="email" id="email" required="required" pattern="[a-z0-9._%+\-]+@[a-z0-9.\-]+\.[a-z]{2,}$">
      <br> <br>
      <fieldset>
        <legend>Address</legend>
        <label for="street" class="Textlabel">Street Address</label>
        <input type="text" name="street" id="street" required="required" pattern="[A-Za-z0-9\s]{5,40}">

        <label for="suburb" class="Textlabel">Suburb/Town</label>
        <input type="text" name="suburb" id="suburb" required="required" pattern="[A-Za-z\s]{5,40}">

        <label for="state" class="Textlabel">State</label>
        <select name="state" id="state" required="required" class="State">
          <option value="">Please Select</option>
          <option value="VIC">VIC</option>
          <option value="NSW">NSW</option>
          <option value="QLD">QLD</option>
          <option value="NT">NT</option>
          <option value="WA">WA</option>
          <option value="SA">SA</option>
          <option value="TAS">TAS</option>
          <option value="ACT">ACT</option>
        </select>
        <br><br>
        <label for="postcode" class="Textlabel">Postcode</label>
        <input type="text" name="postcode" id="postcode" required pattern="[0-9]{4}">
      </fieldset>
      <br><br>
      <fieldset>
        <legend class="Textlabel">Skills</legend>
        <br>
        <input type="checkbox" id="skills1" name="skills1" value="Html">
        <label for="skills1" class="SkillsOption">Html</label><br>

        <input type="checkbox" id="skills2" name="skills2" value="Css">
        <label for="skills2" class="SkillsOption">Css</label><br>

        <input type="checkbox" id="skills3" name="skills3" value="Java Script">
        <label for="skills3" class="SkillsOption">Java Script</label><br>

        <input type="checkbox" id="skills4" name="skills4" value="PhP">
        <label for="skills4" class="SkillsOption">PhP</label><br><br>

        <label for="otherSkills" class="Textlabel">Other Skills:</label>
        <textarea id="otherSkills" name="otherSkills" class="otherSkills" placeholder="Other Skills I Have..."></textarea>
      </fieldset>

      <figure class="container">
        <button class="Apply-btn">
          <img src="./styles/image/button.svg" alt="Send Icon">
          <span>Submit Application</span>
        </button>

      </figure>



    </form>
  </section>
</main>
<?php require "includes/footer.inc"; ?>