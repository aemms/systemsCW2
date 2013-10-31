<?php include('header.php') ?>
<body>
<h1>Register here!</h1>
<p>Fill in your name and email address, then click <strong>Submit</strong> to register.</p>
<form method="post" action="index.php" enctype="multipart/form-data" >
      Name  <input type="text" name="name" id="name"/></br>
      Email <input type="text" name="email" id="email"/></br>
      Company Name <input type="text" name="companyName" id="companyName"/></br>
      <input type="submit" name="submit" value="Submit" />
</form>
<?php
    // DB connection info
    //TODO: Update the values for $host, $user, $pwd, and $db
    //using the values you retrieved earlier from the portal.
    // Database=systemsA12lVzdp3;Data Source=eu-cdbr-azure-west-b.cloudapp.net;User Id=b4d71357152f0e;Password=ed689257
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
        $email = $_POST['email'];
        $companyName = $_POST['companyName'];
        $date = date("Y-m-d");
        // Insert data
        $sql_insert = "INSERT INTO registration_tbl (name, email, date, companyName) 
                   VALUES (?,?,?,?)";
        $stmt = $conn->prepare($sql_insert);
        $stmt->bindValue(1, $name);
        $stmt->bindValue(2, $email);
        $stmt->bindValue(3, $date);
        $stmt->bindValue(4, $companyName);
        $stmt->execute();
    }
    catch(Exception $e) {
        die(var_dump($e));
    }
    echo "<h3>Your're registered!</h3>";
    }
    // Retrieve data
    $sql_select = "SELECT * FROM registration_tbl";
    $stmt = $conn->query($sql_select);
    $registrants = $stmt->fetchAll(); 
    if(count($registrants) > 0) {
        echo "<h2>People who are registered:</h2>";
        echo "<table>";
        echo "<tr><th>Name</th>";
        echo "<th>Email</th>";
        echo "<th>Company Name</th>";
        echo "<th>Date</th></tr>";
        foreach($registrants as $registrant) {
            echo "<tr><td>".$registrant['name']."</td>";
            echo "<td>".$registrant['email']."</td>";
            echo "<td>".$registrant['companyName']."</td>";
            echo "<td>".$registrant['date']."</td></tr>";
        }
        echo "</table>";
    } else {
        echo "<h3>No one is currently registered.</h3>";
    }
?>
</body>
<?php include("footer.php") ?>