<?php
	/*submitTestcase.php*/
	require_once( "include.php" );
	$conn = getConnection(); //set to DB Conn
	
	if(strtoupper($_SERVER["REQUEST_METHOD"]) === "POST") {
		
		
		$testID = $_POST['testcaseID'];
		$submissionFrom = $_POST['name'];
		
		include "Testcase.php";
		include "Steps.php";
		include "Testresult.php";
		
		
		$testcase = new Testcase($conn);
		$testcase = $testcase->load( $testID );
		
		$Testresult = new Testresult($conn);
		
		$passCount = 0;
		$failCount = 0;
		
		
		$paragraphs = "<table><tr><th>Step</th><th>Regression</th><th>Expected</th><th>Pass/Fail</th><th>Notes</th></tr>";


		
		if( isset($_POST['stepsID'])  && is_array($_POST['stepsID']) ){
			for($x =0; $x < sizeof($_POST['stepsID']); $x++ ){
				
				if( $_POST['pass'][$x] == "Passed" ){
					$passCount++;
				}else{
					$failCount++;
				}
				
				$step = new Steps($conn);
				$step = $step->load ( $_POST['stepsID'][$x] );
				

				$paragraphs .= "<tr><td>".$step->getStep()."</td><td>".$step->getRegression()."</td><td>".$step->getResult()."</td><td>". $_POST['pass'][$x]."</td><td>".$_POST['notes'][$x]."</td></tr>";	
				
			}
		}
		
		$total = $passCount + $failCount;
		
		
		$paragraphs .= "</table>";
		
		$headers = "From: birwin@wlu.ca;\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		
		$message = '<html><body>';
		$message .= '<h1>Test Submission - '.(isset($testcase) ?  $testcase->getTid() : '').'</h1>';
		$message .= '<p><b>Test Description:</b> '.(isset($testcase) ?  $testcase->getDescription() : '').'</p>';
		$message .= '<p><b>Test %</b> '.(($passCount/$total) * 100).'</p>';
		$message .= '<p><b>Test Taken by:</b> '.$_POST['name'].'</p>';
		$message .= '<p><b>Passed:</b> '.$passCount.'</p>';
		$message .= '<p><b>Failed:</b> '.$failCount.'</p>';
		
		$message .=  $paragraphs;
		
		$message .= '<p>Completed on: '.date("Y-m-d H:i:s").'</p>';
		
		$message .= '</body></html>';
		
		
		$to = "dawilliams@wlu.ca";
		$subject = "Test Case submission of: ".(isset($testcase) ?  $testcase->getTid() : '').' by: '.$_POST['name'];
		
		$query = $conn->prepare("SELECT COUNT(`id`) as `cnt` FROM `testresult` WHERE `testresult`.`testID` = :ID");
		$query->bindParam('ID', $testcase->getId() );
		$result = 0;
		if( $query->execute() ){
			$result = $query->fetchAll();
			
			$result = $result[0]["cnt"];
		}
		
		

		$Testresult->setTestID( $testcase->getId() );
		$Testresult->setTestName( $testcase->getTid()."-".$result ); 
		$Testresult->setTestNum( $result );
		$Testresult->setPass( $passCount );
		$Testresult->setFail( $failCount );
		$Testresult->setTaker( $_POST['name'] );
		$Testresult->setHtml($message);

		if( $failCount > 0){
			if( mail($to,$subject,$message,$headers) ){
				echo "<h1>Thank you for the submission...</h1>";
				//echo '<pre>'.print_r($_POST, true).'</pre>';
			}
		}
		
		if( $Testresult->save() ){
				echo "<p>Your result was recorded.</p>";
		}
		
	}else{
		//
	}
?>