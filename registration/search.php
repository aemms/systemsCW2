<?php include_once('header.php') ?>
<body>
    <h2>Search</h2> 
     <form name="search" method="post" action="<?=$PHP_SELF?>">
        Seach for: <input type="text" name="find" /> in 
        <Select NAME="field">
        <Option VALUE="name">Name</option>
        <Option VALUE="email">Email</option>
        <Option VALUE="companyName">Company Name</option>
    </Select>
        <input type="hidden" name="searching" value="yes" />
        <input type="submit" name="search" value="Search" />
     </form>
<?php
    // DB connection info
    //TODO: Update the values for $host, $user, $pwd, and $db
    // Database=systemsA12lVzdp3;Data Source=eu-cdbr-azure-west-b.cloudapp.net;User Id=b4d71357152f0e;Password=ed689257
    $host = "eu-cdbr-azure-west-b.cloudapp.net";
    $user = "b4d71357152f0e";
    $pwd = "ed689257";
    $db = "systemsA12lVzdp3";

        <? 
     //This is only displayed if they have submitted the form 
     if ($searching =="yes") 
     { 
     echo "<h2>Results</h2><p>"; 
     
     //If they did not enter a search term we give them an error 
     if ($find == "") 
     { 
     echo "<p>You forgot to enter a search term"; 
     exit; 
     } 
     
     // Otherwise we connect to our Database 
     mysql_connect("eu-cdbr-azure-west-b.cloudapp.net", "b4d71357152f0e", "ed689257") or die(mysql_error()); 
     mysql_select_db("systemsA12lVzdp3") or die(mysql_error()); 
     
     // We preform a bit of filtering 
     $find = strtoupper($find); 
     $find = strip_tags($find); 
     $find = trim ($find); 
     
     //Now we search for our search term, in the field the user specified 
     $data = mysql_query("SELECT * FROM registration_tbl WHERE name LIKE '%{$term}%' OR email LIKE '%{$term}%' OR companyName LIKE '%{$term}%';"); 
     
     //And we display the results 
     while($result = mysql_fetch_array( $data )) 
     { 
     echo $result['name']; 
     echo " "; 
     echo $result['email']; 
     echo "<br>"; 
     echo $result['companyName']; 
     echo "<br>"; 
     echo "<br>"; 
     } 
     
     //This counts the number or results - and if there wasn't any it gives them a little message explaining that 
     $anymatches=mysql_num_rows($data); 
     if ($anymatches == 0) 
     { 
     echo "Sorry, but we can not find an entry to match your query<br><br>"; 
     } 
     
     //And we remind them what they searched for 
     echo "<b>Searched For:</b> " .$find; 
     } 
     ?> 
</body>
<?php include_once("footer.php") ?>