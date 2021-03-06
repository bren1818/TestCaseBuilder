<?php
/*
Ajax Form Generated by Brendon Irwin's Form Generator
Query Form: "Steps" Object 


ajaxTableSteps.php 

*/

		include "include.php";

		$type = $_GET["type"];

		$draw = $_GET["draw"];

		$start = $_GET["start"];

		$length =  (int)($_GET["length"]);

		$orderBy = (int)$_GET["order"][0]["column"];

		$orderDir = $_GET["order"][0]["dir"];

		$orderDir = ($orderDir == "asc" ? "ASC" : "DESC");

		$search = isset($_GET['search']['value']) ? $_GET['search']['value'] : '';

		if( $search != ""){

			$search = "%".$search."%";

		}

		if( $start < 0 || !is_int($start) ){

			$start = 0;

		}

		$conn = getConnection();

		$query = "SELECT COUNT(`id`) as `cnt` FROM `steps`";

		$result = $conn->prepare($query);

		$result->execute();

		$result = $result->fetchAll(PDO::FETCH_ASSOC);

		$recordsTotal = $result[0]['cnt'];

		if( $orderBy != "" && is_int($orderBy) ){

			switch($orderBy){

				case 0:

					$orderBy = "steps.`id`";

				break;

				case 1:

					$orderBy = "`regression`";

				break;

				case 2:

					$orderBy = "`result`";

				break;

				case 3:

					$orderBy = "`pass`";

				break;

				default:

					$orderBy = "`id`";

				break;

			}

		}else{

			$orderBy = "`id`";

		}

		$query = "SELECT `id`,

			`regression`,`result`,`pass`

		FROM

			`steps`

		WHERE

			".( $search != "" ? " (`regression` ".($search != "" ? " LIKE :SEARCH" : "").") OR (`result` ".($search != "" ? " LIKE :SEARCH" : "").") OR (`pass` ".($search != "" ? " LIKE :SEARCH" : "").")" : " 1 ") ."

		ORDER BY

			".$orderBy." ".$orderDir."

		LIMIT :START,:LENGTH";

		$result = $conn->prepare($query);

		$result->bindParam(':LENGTH', $length, PDO::PARAM_INT);

		$result->bindParam(':START', $start, PDO::PARAM_INT);

		if( $search != ""){

			$result->bindParam(':SEARCH', $search, PDO::PARAM_STR);

		}

		$result->execute();	

		$results = $result->fetchAll(PDO::FETCH_ASSOC);

		foreach( $results as $row){

		$id = $row['id'];

		$data[] =  array(

			$row["id"], $row["regression"], $row["result"], $row["pass"], "<a href='modifySteps.php?stepsID=$id'>Modify</a><a href='deleteSteps.php?stepsID=$id'>Delete</a>"

		);

		}

		if( sizeof($results) == 0 ){ $data = array(); }

		$recordsFiltered =  sizeof( $data ) ;

		ob_clean();

		echo json_encode( array( "draw" => (int)($draw), "recordsTotal" => $recordsTotal, "recordsFiltered" => $recordsFiltered, "data" => $data, "error" => "") ); 

		exit;
?>