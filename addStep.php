<?php
	require_once( "include.php" );
	require_once("Steps.php");
	function addStep($id, $stepNum=""){
		if( $id != ""){
			$conn = getConnection();
			
			$steps = new Steps($conn);
			$steps = $steps->load($id);
		}else{
			
			$steps = new Steps();
			$steps->setStep($stepNum);
		}
		?>
		<div class="step">
			<table>
				<tr>
					<td class="stepNum">Step</td>
					<td class="testStep">Test Step</td>
					<td class="expectedResult">Expected Result</td>
					<td class="result">Result</td>
				</tr>
				<tr>
					<td class="stepNum"><input type="text" name="step[]" id="step" value="<?php echo (isset($steps) ?  $steps->getStep() : ''); ?>"  title="" /></td>
					<td class="testStep"><textarea class="wysiwyg"  name="regression[]" id="regression"  required="required"  title="Full Regression is a required field. " ><?php echo (isset($steps) ?  $steps->getRegression() : ''); ?></textarea></td>
					<td class="expectedResult"><textarea class="wysiwyg"  name="result[]" id="result"  required="required"  title="Task and Expected Result is a required field. " ><?php echo (isset($steps) ?  $steps->getResult() : ''); ?></textarea></td>
					<td class="notes">
						<?php $pass_values = array("Passed", "Failed"); ?>
						<select name="pass[]">
						<option value="Choose">Choose</option>
						<?php for($sm = 0; $sm < sizeof( $pass_values); $sm++){ ?>
							<option value="<?php echo trim($pass_values[$sm]); ?>" <?php echo ( trim($steps->getPass()) == trim($pass_values[$sm]) ) ?  " selected" : "";  ?>>
								<?php echo $pass_values[$sm]; ?>
							</option>
						<?php } ?>
						</select>
					</td>
				</tr>
			</table>
			<input type="hidden" name="stepsID[]" value="<?php echo $steps->getID(); ?>" />
		</div>
		<?php
	}
	
	
	function addStep_d($id, $stepNum=""){
		if( $id != ""){
			$conn = getConnection();
			
			$steps = new Steps($conn);
			$steps = $steps->load($id);
		}else{
			
			$steps = new Steps();
			$steps->setStep($stepNum);
		}
		?>
		<div class="step">
			<table border="1">
				<tr>
					<td class="stepNum">Step</td>
					<td class="testStep">Test Step</td>
					<td class="expectedResult">Expected Result</td>
					<td class="result">Result</td>
					<td class="notes">Notes (if Failed)</td>
				</tr>
				<tr>
					<td class="stepNum"><?php echo (isset($steps) ?  $steps->getStep() : ''); ?></td>
					<td class="testStep"><?php echo (isset($steps) ?  $steps->getRegression() : ''); ?></td>
					<td class="expectedResult"><?php echo (isset($steps) ?  $steps->getResult() : ''); ?></td>
					<td class="result">
						<?php $pass_values = array("Passed", "Failed"); ?>
						<select name="pass[]">
						<option value="Choose">Choose</option>
						<?php for($sm = 0; $sm < sizeof( $pass_values); $sm++){ ?>
							<option value="<?php echo trim($pass_values[$sm]); ?>" <?php echo ( trim($steps->getPass()) == trim($pass_values[$sm]) ) ?  " selected" : "";  ?>>
								<?php echo $pass_values[$sm]; ?>
							</option>
						<?php } ?>
						</select>
					</td>
					<td class="notes">
						<textarea class="notes" name="notes[]"></textarea>
					</td>
				</tr>
			</table>
			<input type="hidden" name="stepsID[]" value="<?php echo $steps->getID(); ?>" />
		</div>
		<?php
	}
	
	
	if( isset($_REQUEST['n']) ){
		$step = "";
		if( isset($_REQUEST["step"] ) && $_REQUEST["step"] != "" ){
			$step = $_REQUEST["step"];
		}
		addStep("", $step);
	}
?>