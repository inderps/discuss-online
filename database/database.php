<?php
class Database{
function RetreiveQ($query){
		include(dirname(__FILE__). DIRECTORY_SEPARATOR."..". DIRECTORY_SEPARATOR."config". DIRECTORY_SEPARATOR."mysqldetails.php");
    	$con = mysql_connect($mysqlhost,$mysqluser,$mysqlpass);
		if (!$con)
  			{
  				die('Could not connect: ' . mysql_error());
  			}
		try {
				mysql_select_db($mysqldb, $con);
				$result = mysql_query($query);
				return $result;
		}
		catch(Exception $e){die('Error: '  .$e->getMessage());}
    }
function UpdateQ($query){
		include(dirname(__FILE__). DIRECTORY_SEPARATOR."..". DIRECTORY_SEPARATOR."config". DIRECTORY_SEPARATOR."mysqldetails.php");
    	$con = mysql_connect($mysqlhost,$mysqluser,$mysqlpass);
		if (!$con)
  			{
  				die('Could not connect: ' . mysql_error());
  			}
		try {
				mysql_select_db($mysqldb, $con);
				mysql_query("SET NAMES utf16",$con);
				if (!mysql_query($query,$con))
  					{
  						die('Error: '  .mysql_error());
  					}
				return (true);
			}
		catch(Exception $e){die('Error: '  .$e->getMessage());}
    }
} 
?>
