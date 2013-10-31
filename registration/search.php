<?php require_once('header.php') ?>
<body>
    <h2>Search</h2> 
     <form name="search" method="post" action="<?=$PHP_SELF?>">
        Search for: <input type="text" name="find" /> in 
        <select NAME="field">
            <option VALUE="name">Name</option>
            <option VALUE="email">Email</option>
            <option VALUE="companyName">Company Name</option>
        </select>
        <input type="hidden" name="searching" value="yes" />
        <input type="submit" name="search" value="Search" />
     </form>
<?php
     //This is only displayed if they have submitted the form 
     if ($searching =="yes") 
     { 
     echo "<h2>Results</h2><p>"; 
     
     //If they did not enter a search term we give them an error 
     if ($find == "") 
     { 
     echo "<p>You forgot to enter a search term</p>"; 
     exit; 
     } 
     
     // Otherwise we connect to our Database 
     mysql_connect("eu-cdbr-azure-west-b.cloudapp.net", "b4d71357152f0e", "ed689257") or die(mysql_error()); 
     mysql_select_db("systemsA12lVzdp3") or die(mysql_error()); 
     
     // We preform a bit of filtering 

     //Now we search for our search term, in the field the user specified 
     $data = mysql_query("SELECT * FROM registration_tbl WHERE $field LIKE '%{$find}%';"); 
     
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
<?php require_once("footer.php") ?>