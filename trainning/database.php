<?php
$db_server="localhost";
$db_user="root";
$db_pass="";
$db_name="test";
$db_port=3307;
$conn="";

try{$conn=mysqli_connect($db_server
                    ,$db_user
                    ,$db_pass
                    ,$db_name,$db_port);
                }
catch(mysqli_sql_exception){
    echo "couldnt connect <br>";
}

                

// initializing db so that it can be used in other files
// the initialize might not work 3ndkon 3ashen i used nother port for the xamp



?>
