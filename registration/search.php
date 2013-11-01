<?php require_once('header.php') ?>
<body>
<h1>Search Register here!</h1>
<p>Fill in your name then click <strong>Submit</strong> to search.</p>
<form method="post" action="search.php" enctype="multipart/form-data" >
      Name  <input type="text" name="name" id="name"/></br>
   
      <input type="submit" name="submit" value="Submit" />
</form>
<?php
    // DB connection info
    //TODO: Update the values for $host, $user, $pwd, and $db
    //using the values you retrieved earlier from the portal.
    $host = "eu-cdbr-azure-west-b.cloudapp.net";
    $user = "b4d71357152f0e";
    $pwd = "ed689257";
    $db = "systemsA12lVzdp3";
    // Connect to database.
    try {
        $conn = new PDO( "mysql:host=$host;dbname=$db", $user, $pwd);
        $conn->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    }
    catch(Exception $e){
        die(var_dump($e));
    }
    // Insert registration info
    if(!empty($_POST)) {
    try {
        $name = $_POST['name'];
        // Insert data
        $sql_select = "select * from registration_tbl where name LIKE CONCAT ('%',?,'%')";

        $stmt = $conn->prepare($sql_select);

        $stmt->bindValue(1, $name);
        $stmt->execute();

        $rows = $stmt->fetchAll();
        
        if(count($rows) > 0) {
            echo "<h2>Records:</h2>";
            echo "<table>";
            echo "<tr><th>Name</th>";
            echo "<th>Email</th>";
            echo "<th>Company</th>";
            echo "<th>Date</th></tr>";
            foreach($rows as $row) {
                echo "<tr><td>".$row['name']."</td>";
                echo "<td>".$row['email']."</td>";
                echo "<td>".$row['company']."</td>";
                echo "<td>".$row['date']."</td></tr>";
            }
            echo "</table>";
        } else {
            echo "<h3>No one is currently registered.</h3>";
        }
    }
    catch(Exception $e) {
        die(var_dump($e));
    }
    echo "<h3>Your're registered!</h3>";
    }
    // Retrieve data
 
?>
</body>
<?php require_once("footer.php") ?>