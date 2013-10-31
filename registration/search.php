<?php require_once('header.php') ?>
<body>
    <<h1>Search</h1>
<p>Fill in the name to search then click <strong>Submit</strong> to search.</p>
<form name="search" method="post" action="search.php">
    Search:<input type="text" name="query" value=""/>
    <input type="submit" name="searchClick" value="Find" />
</form>

<?php
    $host = "eu-cdbr-azure-west-b.cloudapp.net";
    $user = "b4d71357152f0e";
    $pwd = "ed689257";
    $db = "systemsA12lVzdp3";
    if(isset($_POST['searchClick'])) {
        $term = $_POST['query'];
        
        // connect to DB
        mysql_connect($host, $user, $pwd);
        mysql_select_db($db);

        $find = mysql_query("SELECT * FROM registration_tbl WHERE name LIKE '%{$term}%' OR email LIKE '%{$term}%' OR companyName LIKE '%{$term}%';");

        echo "<table>
              <th>Name Results</th>
              <th>Email Results</th>
              <th>Company Name Results</th>
              <br>
             ";

        while($row = mysql_fetch_array($find)) {
            echo "<tr><td>";  
            echo $row['name'];
            echo " </td>";
            echo "<td>";
            echo $row['email'];
            echo " </td>";
            echo "<td>";
            echo $row['companyName'];
            echo "<br>";
            echo " </td></tr>";
        }
        echo "</table>";
        echo "HELLO!";
    }
?>
</body>
<?php require_once("footer.php") ?>