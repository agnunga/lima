<?php

define("DBHOST","localhost",true);

define("DBUSERNAME","root",true);

define("DBPASSWORD","@jadi21",true);

define("DBNAME","iems_db",true);



function insertSms($sender,$text)

{	

	$con = 'mysql:dbname='.DBNAME.';host='.DBHOST;

	try {

    		$cmd = new PDO($con,DBUSERNAME,DBPASSWORD);

			$stmt = $cmd->prepare("INSERT INTO kannel_tuto (number,message) VALUES (:sender,:message)");

			$stmt->bindParam(':sender',$sender);

			$stmt->bindParam(':message',$text);

			$stmt->execute();

			$cmd = null;

				

				if($stmt->rowCount()>0)

				{

					echo "Hello ".$text.". Thank you for your registration.";

				}

				else

				{

					echo "Sorry an error has occured";

				}

				

			}		 

		catch (PDOException $e) {

    		echo 'Connection failed: ' . $e->getMessage();

			}

}





insertSms($_GET['sender'],$_GET['text']);

