<?php 
// this code will only execute after the submit button is clicked
if (isset($_POST['submit'])) {
	
    // include the config file that we created before
    require "../config.php"; 
    
    // this is called a try/catch statement 
	try {
        // FIRST: Connect to the database
        $connection = new PDO($dsn, $username, $password, $options);
		
        // SECOND: Get the contents of the form and store it in an array
        $new_entry = array( 
            "planttype=" => $_POST['planttype'], 
            "height" => $_POST['height'],
            "watered" => $_POST['watered'],
            "notes" => $_POST['notes'], 
        );
        
        // THIRD: Turn the array into a SQL statement
        $sql = "INSERT INTO entries (planttype, height, watered, notes) VALUES (:planttype, :height, :watered, :notes)";        
        
        // FOURTH: Now write the SQL to the database
        $statement = $connection->prepare($sql);
        $statement->execute($new_work);
	} catch(PDOException $error) {
        // if there is an error, tell us what it is
		echo $sql . "<br>" . $error->getMessage();
	}	
}
?>


<?php include "templates/header.php"; ?>

<h2>Add an Entry</h2>

<?php if (isset($_POST['submit']) && $statement) { ?>
<p>Entry successfully added.</p>
<?php } ?>

<!--form to collect data for each artwork-->

<form method="post">
    <label for="planttype">Plant Type</label>
    <input type="text" name="planttype" id="planttype">

    <label for="height">Height</label>
    <input type="text" name="height" id="height">

    <label for="watered">Watered</label>
    <input type="text" name="watered" id="watered">

    <label for="notes">Notes</label>
    <input type="text" name="notes" id="notes">

    <input type="submit" name="submit" value="Submit">

</form>

<?php include "templates/footer.php"; ?>