					<?php
					//some instances may bark if date isn't set
					date_default_timezone_set("America/New_York");

					function getConnection() {
						
						$dbName = "testCase"; 			//Database Name
						$dbUser = "root"; 			//Database User
						$dbPass = ""; 	//Database Password
						$dbHost = "localhost";
						
						$dbc = null;
						try {
							$dbc = new PDO('mysql:host='.$dbHost.';dbname='.$dbName, $dbUser, $dbPass);
							$dbc->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
						}
						catch(PDOException $e) {
							echo "<h2>An error has occurred connecting to the database</h2>";
							echo "<p>".$e->getMessage()."</p>";
							file_put_contents('PDOErrorsLog.txt', $e->getMessage(), FILE_APPEND);
						}
						return $dbc;
					}

					/* Example usage
					$conn = getConnection();
					$someClass = new someClass($conn);
					$someClass = $someClass->load( $someID );
					*/
					?>
					