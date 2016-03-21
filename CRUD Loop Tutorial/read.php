<?php
    require 'database.php';
    $id = null;
    // GETS the Primary Key (unique indetifier) of the contact you want to view
    // from the hidden variable in the href link of the button
    if ( !empty($_GET['id'])) {
        $id = $_REQUEST['id'];
    }
    
    // If there is no ID (PK), the button will redirect you back to index.php. 
    if ( null==$id ) {
        header("Location: index.php");
    } else {
        $pdo = Database::connect();
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        // Selecting all data where the ID equals that selected.
        $sql = "SELECT * FROM contacts where id = ?";
        $q = $pdo->prepare($sql);
        $q->execute(array($id));
        // All data is stored in this variable
        $data = $q->fetch(PDO::FETCH_ASSOC);
        Database::disconnect();
    }
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css"
    integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
</head>
 
<body>
    <div class="container">
     
        <div class="span10 offset1">
            <div class="row">
                <h3>Read a Contact</h3>
            </div>
            <br>
            <!--Takes data from $data above and places it into HTML-->
            <div class="form-horizontal" >
              <div class="control-group">
                <label class="control-label">Name</label>
                <div class="controls">
                    <!--Each piece of data is encapsulated inside the label-->
                    <label class="checkbox">
                        <?php echo $data['name'];?>
                    </label>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Email Address</label>
                <div class="controls">
                    <label class="checkbox">
                        <?php echo $data['email'];?>
                    </label>
                </div>
              </div>
              <div class="control-group">
                <label class="control-label">Mobile Number</label>
                <div class="controls">
                    <label class="checkbox">
                        <?php echo $data['mobile'];?>
                    </label>
                </div>
                <br>
              </div>
                <div class="form-actions">
                  <a class="btn" href="index.php">Back</a>
               </div>
            </div>
        </div>
                 
    </div>
  </body>
</html>