<!--Form Generated by Brendon Irwin's Form Generator-->
<!--Admin Form: "Testresult" Object -->


<!-- TestresultAdmin.php -->


<!--Recommended include -->
<script src="https://code.jquery.com/jquery-2.2.2.min.js"   integrity="sha256-36cp2Co+/62rEAAYHLmRCPIych47CvdM+uTBJwSzWjI="   crossorigin="anonymous"></script>
<link rel="stylesheet" href="//cdn.datatables.net/1.10.9/css/jquery.dataTables.min.css" />
<script src="//cdn.datatables.net/1.10.9/js/jquery.dataTables.min.js"></script>


<!--<p><a href="createTestresult.php">Create New Testresult</a></p>-->
<p><a href="TestcaseAdmin.php">See Available Tests</a></p>
<fieldset>

	<legend>Testresult</legend>

		<table id="tbl_Testresults" class="dataTable display" cellspacing="0" width="100%">

			<thead>

				<tr>

					<th>ID</th><th>Test ID</th><th>Test Name</th><th>test Number</th><th>Pass Count</th><th>Fail Count</th><th>Test Taker</th>

					<th>Controls</th>

				</tr>

			</thead>

			<tbody>

				<?php

					include "include.php";

					$conn = getConnection();

							?>

			</tbody>

			<tfoot>

				<tr>

					<th>ID</th><th>Test ID</th><th>Test Name</th><th>test Number</th><th>Pass Count</th><th>Fail Count</th><th>Test Taker</th>

					<th>Controls</th>

				</tr>

			</tfoot>

		</table>
</fieldset>
<a href="exportTestresult.php">Download Data in CSV Format</a>
<script type="text/javascript">

		$(function(){

			/* Optional Configurations commented out */

			$("#tbl_Testresults").DataTable({

				"processing": true,

				"serverSide": true,

				"ajax": "ajaxTableTestresult.php",

				//"columns" :  [ {"name": "0", "orderable": "true"}, {"name": "1", "orderable": "true"}, {"name": "2", "orderable": "true"}, {"name": "3", "orderable": "true"} ]

			});

		});
</script>
