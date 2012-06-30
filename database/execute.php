<?php 
$sqlErrorText = '';
$sqlErrorCode = 0;
$sqlStmt='';

include("../config/mysqldetails.php");
mysql_connect($mysqlhost,$mysqluser,$mysqlpass);
$sqlArray = explode(';',file_get_contents('schema.sql'));
foreach ($sqlArray as $stmt) {          	
	if (strlen($stmt)>3){
        $result = mysql_query($stmt);
        if (!$result){
           	 $sqlErrorCode = mysql_errno();
           	 $sqlErrorText = mysql_error();
           	 $sqlStmt      = $stmt;
			 echo "ERROR: " .$sqlErrorText . " ON LINE" .$sqlStmt . "<br/>";
        }
    }
}
 if($sqlErrorCode==0)
 	echo "Successfully done";
 else
 	echo "ERROR: " .$sqlErrorText . " ON LINE" .$sqlStmt;		
?>