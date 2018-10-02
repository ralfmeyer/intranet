<?php
    echo "\n";
    $serverName = @"tcp:server=ep-sql\epsql,1433";
    $connectionOptions = array("Database"=>"eipro1", "Uid"=>"test", "PWD"=>"test");
	
     //Establishes the connection
     try{
     $conn = sqlsrv_connect($serverName, $connectionOptions);
     }
     catch(Exception $e){
         echo "Fehler: ".$e->getMessage();
         die();
     }
     echo "Verbunden";
     die();
	 //Select Query
	 $tsql = "SELECT [CompanyName] FROM SalesLT.Customer";
	 //Executes the query
	 $getProducts = sqlsrv_query($conn, $tsql);
	 //Error handling