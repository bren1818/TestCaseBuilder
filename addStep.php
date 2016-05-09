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
					<td>Step</td>
					<td>Full / Regression</td>
					<td>Task & Expected Result</td>
					<td>Pass / Fail</td>
				</tr>
				<tr>
					<td><input type="text" name="step[]" id="step" value="<?php echo (isset($steps) ?  $steps->getStep() : ''); ?>"  title="" /></td>
					<td><textarea class="wysiwyg"  name="regression[]" id="regression"  required="required"  title="Full Regression is a required field. " ><?php echo (isset($steps) ?  $steps->getRegression() : ''); ?></textarea></td>
					<td><textarea class="wysiwyg"  name="result[]" id="result"  required="required"  title="Task and Expected Result is a required field. " ><?php echo (isset($steps) ?  $steps->getResult() : ''); ?></textarea></td>
					<td>
						<?php $pass_values = array("Passed", "Failed"); ?>
						<select name="pass[]">
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
					<td>Step</td>
					<td>Full / Regression</td>
					<td>Task & Expected Result</td>
					<td>Pass / Fail</td>
					<td>Notes (if Failed)</td>
				</tr>
				<tr>
					<td><?php echo (isset($steps) ?  $steps->getStep() : ''); ?></td>
					<td><?php echo (isset($steps) ?  $steps->getRegression() : ''); ?></td>
					<td><?php echo (isset($steps) ?  $steps->getResult() : ''); ?></td>
					<td>
						<?php $pass_values = array("Passed", "Failed"); ?>
						<select name="pass[]">
						<?php for($sm = 0; $sm < sizeof( $pass_values); $sm++){ ?>
							<option value="<?php echo trim($pass_values[$sm]); ?>" <?php echo ( trim($steps->getPass()) == trim($pass_values[$sm]) ) ?  " selected" : "";  ?>>
								<?php echo $pass_values[$sm]; ?>
							</option>
						<?php } ?>
						</select>
					</td>
					<td>
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