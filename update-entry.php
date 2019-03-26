
<?php 
    // include the config file that we created last week
    require "../config.php";
    require "common.php";
    // run when submit button is clicked
    if (isset($_POST['submit'])) {
        try {
            $connection = new PDO($dsn, $username, $password, $options);  
            
            //grab elements from form and set as varaible
            $work =[
              "id"         => $_POST['id'],
              "planttype" => $_POST['planttype'],
              "height"  => $_POST['height'],
              "watered"   => $_POST['notes'],
            ];
            
            // create SQL statement
            $sql = "UPDATE `entries` 
                    SET id = :id, 
                        planttype = :planttype, 
                        height = :height, 
                        watered = :watered, 
                        notes = :notes,  
                    WHERE id = :id";
            //prepare sql statement
            $statement = $connection->prepare($sql);
            
            //execute sql statement
            $statement->execute($work);
        } catch(PDOException $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
    }
    // GET data from DB
    //simple if/else statement to check if the id is available
    if (isset($_GET['id'])) {
        //yes the id exists 
        
        try {
            // standard db connection
            $connection = new PDO($dsn, $username, $password, $options);
            
            // set if as variable
            $id = $_GET['id'];
            
            //select statement to get the right data
            $sql = "SELECT * FROM entries WHERE id = :id";
            
            // prepare the connection
            $statement = $connection->prepare($sql);
            
            //bind the id to the PDO id
            $statement->bindValue(':id', $id);
            
            // now execute the statement
            $statement->execute();
            
            // attach the sql statement to the new work variable so we can access it in the form
            $work = $statement->fetch(PDO::FETCH_ASSOC);
            
        } catch(PDOExcpetion $error) {
            echo $sql . "<br>" . $error->getMessage();
        }
    } else {
        // no id, show error
        echo "No id - something went wrong";
        //exit;
    };
?>

<?php include "templates/header.php"; ?>

<?php if (isset($_POST['submit']) && $statement) : ?>
	<p>Entry successfully updated.</p>
<?php endif; ?>

<h2>Edit a Entry</h2>

<form method="post">
    
    <label for="id">ID</label>
    <input type="text" name="id" id="id" value="<?php echo escape($work['id']); ?>" >
    
    <label for="planttype">Plant Type</label>
    <input type="text" name="planttype" id="planttype" value="<?php echo escape($work['planttype']); ?>">

    <label for="height">Height</label>
    <input type="text" name="height" id="height" value="<?php echo escape($work['height']); ?>">

    <label for="watered">Watered</label>
    <input type="text" name="watered" id="watered" value="<?php echo escape($work['watered']); ?>">

    <label for="notes">Notes</label>
    <input type="text" name="notes" id="notes" value="<?php echo escape($work['notes']); ?>">

    <input type="submit" name="submit" value="Save">

</form>





<?php include "templates/footer.php"; ?>