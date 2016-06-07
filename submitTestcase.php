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
		
		
		$paragraphs = "<table><tr><th class='stepNum'>Step</th><th class='testStep'>Test Step</th><th class='expectedResult'>Expected Result</th><th class='result'>Result</th><th class='notes'>Notes</th></tr>";


		
		if( isset($_POST['stepsID'])  && is_array($_POST['stepsID']) ){
			for($x =0; $x < sizeof($_POST['stepsID']); $x++ ){
				
				if( $_POST['pass'][$x] == "Passed" ){
					$passCount++;
				}else{
					$failCount++;
				}
				
				$step = new Steps($conn);
				$step = $step->load ( $_POST['stepsID'][$x] );
				

				$paragraphs .= "<tr><td class='stepNum'>".$step->getStep()."</td><td class='testStep'>".$step->getRegression()."</td><td class='expectedResult'>".$step->getResult()."</td><td class='result'>". $_POST['pass'][$x]."</td><td  class='notes'>".$_POST['notes'][$x]."</td></tr>";	
				
			}
		}
		
		$total = $passCount + $failCount;
		
		
		$paragraphs .= "</table>";
		
		$headers = "From: TestCaseAdmin@wlu.ca;\r\n";
		$headers .= "MIME-Version: 1.0\r\n";
		$headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
		
		$serverURL = "http://205.189.21.88:81/";
		
		$message = '<html><body>';
		
		$message .= '<style>td.testStep, td.expectedResult, td.notes{ width: 450px; max-width:450px; } td.result{ width: 100px; max-width: 100px;}	td.stepNum{ width: 50px; max-width: 50px;} table, table td{ border: 1px solid #000; }</style>';
		
		$message .= '<h1>Test Submission - '.(isset($testcase) ?  $testcase->getTid() : '').'</h1>';
		$message .= '<p><b>Test Description:</b> '.(isset($testcase) ?  $testcase->getDescription() : '').'</p>';
		$message .= '<p><b>Test %</b> '.round ( ( ($passCount/$total) * 100), 2).'</p>';
		$message .= '<p><b>Test Taken by:</b> '.$_POST['name'].'</p>';
		$message .= '<p><b>Passed:</b> '.$passCount.'</p>';
		$message .= '<p><b>Failed:</b> '.$failCount.'</p>';
		
		$message .=  $paragraphs;
		
		$message .= '<p>Completed on: '.date("Y-m-d H:i:s").'</p>';
		$message .= '<p>Device : '.$_POST['device'].'</p>';
		$message .= '<p>Browser: '.$_POST['browser'].'</p>';
		
		
		
		
		$to = "dawilliams@wlu.ca, birwin@wlu.ca";//dawilliams
		$subject = "Test Case submission of: ".(isset($testcase) ?  $testcase->getTid() : '').' by: '.$_POST['name'];
		
		$query = $conn->prepare("SELECT COUNT(`id`) as `cnt` FROM `testresult` WHERE `testresult`.`testID` = :ID");
		$query->bindParam('ID', $testcase->getId() );
		$result = 0;
		if( $query->execute() ){
			$result = $query->fetchAll();
			
			$result = $result[0]["cnt"];
		}else{
			$result = 1;
		}
		
		

		$Testresult->setTestID( $testcase->getId() );
		
		$Testresult->setBrowser( $_POST['browser']  );
		$Testresult->setDevice( $_POST['device'] );
		
		
		$Testresult->setTestName( $testcase->getTid()."-".$result ); 
		$Testresult->setTestNum( $result );
		$Testresult->setPass( $passCount );
		$Testresult->setFail( $failCount );
		$Testresult->setTaker( $_POST['name'] );
		$Testresult->setHtml($message.'</body></html>');
		
		
		
		//add device
		//add browser
		
		

		if( $Testresult->save() ){
				echo "<p>Your result was recorded.</p>";
		}
		
		$message .= '<p><a href="'.$serverURL.'modifyTestresult.php?testresultID='.$Testresult->getId().'">View this submission</a> or go to '.$serverURL.'modifyTestresult.php?testresultID='.$Testresult->getId().'</p>';
		$message .= '</body></html>';
		
		
		if( $failCount > 0){
			if( mail($to,$subject,$message,$headers) ){
				echo "<h1>Thank you for the submission...</h1>";
				//echo '<pre>'.print_r($_POST, true).'</pre>';
			}
		}else{
			if( mail($to,$subject,"<html><body><p>Test passed every scenario</p></body></html>",$headers) ){
				echo "<h1>Thank you for the submission...</h1>";
			}
		}
		
		
		
	}else{
		//
	}
?>