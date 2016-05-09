<!--Form Generated by Brendon Irwin's Form Generator-->
<!--Delete Form: "Testcase" Object -->


<!-- deleteTestcase.php -->


<?php
		include "include.php";

		$conn = getConnection(); //create DB Connection 

		include "Testcase.php";

		$testcase = new Testcase( $conn );



		if (strtoupper($_SERVER["REQUEST_METHOD"]) == "POST"){

			$testcaseID = $_POST["testcaseID"];

			$testcase = $testcase->load( $testcaseID );

			if( $testcase->delete() ){

				echo "<p>Testcase deleted Successfully</p>";

				echo "<p><a href='createTestcase.php'>Create Testcase</a> or <a href='TestcaseAdmin.php'>Go back to Testcase management area</a></p>";
			}else{

				echo "<p>Error! Could not delete Testcase</p>";

				echo "<p><a href='TestcaseAdmin.php'>Go back to Testcase management area</a></p>";
			}

		}else{

			$testcaseID = $_REQUEST["testcaseID"];

			$testcase = $testcase->load( $testcaseID );

			if( $testcase->getID() > 0 ){

			?>

				<form method="post" action="deleteTestcase.php">

					<p>Are you sure you wish to delete Testcase with ID of: <?php  echo $testcaseID; ?></p>

					<input type="hidden" name="testcaseID" value ="<?php echo $testcase->getId(); ?>"/>

					<input type="submit" value="Yes" /> <a href="TestcaseAdmin.php">Cancel</a>

				</form>

			<?php

			}else{

				echo "<p>Error! Could not load Testcase</p>";

			}

		}
?>
