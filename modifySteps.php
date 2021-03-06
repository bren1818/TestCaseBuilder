<!--Form Generated by Brendon Irwin's Form Generator-->
<!--Update Form: "Steps" Object -->


<!-- modifySteps.php -->



<?php
	include "include.php";

	include "Steps.php";

	$conn = getConnection(); //set to DB Conn
	$steps = new Steps($conn);
	$showForm = 1;
	if(strtoupper($_SERVER["REQUEST_METHOD"]) === "POST") {
		$steps->getFromPost();
		$steps->setID( $_POST["stepsID"] );
		if( $steps->save() > 0 && $steps->getErrorCount() == 0){
			echo "<p>Steps updated successfully!</p>";
			echo "<p><a href='createSteps.php'>Create new Steps</a> or <a href='StepsAdmin.php'>Go back to Steps management area</a></p>";
			$showForm = 0;
		}else{
			echo "<p>Steps contained (".$steps->getErrorCount().") error(s).</p>";
			echo "<p>Errors: ".$steps->getErrors()."</p>";
			echo "<p><a href='StepsAdmin.php'>Go back to Steps management area</a></p>";
		}
	}else{
		$stepsID = $_REQUEST["stepsID"];

		$steps = $steps->load( $stepsID );

		if( $steps->getID() > 0 ){
		}else{
			$showForm = 0;
			echo "<p>Could not load Steps with ID of ".$stepsID."</p>";
		}
	}
	if( $showForm == 1){
?>
<form name="modifySteps" id="modifySteps" method="POST" action="modifySteps.php" enctype="multipart/form-data">
	<div class="formRow">
		<div class="rowLabel">
			<label for="step">Step:</label>
		</div>
		<div class="rowField">
			<input type="text" name="step" id="step" value="<?php echo (isset($steps) ?  $steps->getStep() : ''); ?>"  title="" />
		</div>
	</div>
	<div class="formRow">
		<div class="rowLabel">
			<label for="regression">Full Regression:*</label>
		</div>
		<div class="rowField">
			<textarea class="wysiwyg"  name="regression" id="regression"  required="required"  title="Full Regression is a required field. " ><?php echo (isset($steps) ?  $steps->getRegression() : ''); ?></textarea>
		</div>
	</div>
	<div class="formRow">
		<div class="rowLabel">
			<label for="result">Task and Expected Result:*</label>
		</div>
		<div class="rowField">
			<textarea class="wysiwyg"  name="result" id="result"  required="required"  title="Task and Expected Result is a required field. " ><?php echo (isset($steps) ?  $steps->getResult() : ''); ?></textarea>
		</div>
	</div>
	<div class="formRow">
		<div class="rowLabel">
			<label for="pass">Pass / Fail:*</label>
		</div>
		<div class="rowField">
			<?php $pass_values = array("Passed", " Failed"); ?>
			<?php for($sm = 0; $sm < sizeof( $pass_values); $sm++){ ?>
				<label><?php echo $pass_values[$sm]; ?>: <input type="radio" name="pass" id="pass" value="<?php echo trim($pass_values[$sm]); ?>" <?php if( ( is_object($steps) &&  $steps->getPass() ?  $steps->getPass()  : '') == trim($pass_values[$sm])){ echo " checked"; } ?>  required="required" /></label>
			<?php } ?>
		</div>
	</div>
	<div class="formRow rowCenter">
	<br /> <br />
		<input type="hidden" name="stepsID" value="<?php echo $steps->getID(); ?>" /> 
		<input class="button" type="submit" value="Update" /> 
		<a href="StepsAdmin.php">Cancel</a>
	</div>
</form>
<?php } ?>