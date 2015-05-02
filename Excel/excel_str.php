<?php

require_once 'reader.php';


  
	$data = new Spreadsheet_Excel_Reader();
	$data->setOutputEncoding('UTF-8');
	$data->read('test.xls');
	error_reporting(E_ALL ^ E_NOTICE);
	//set_time_limit(0);
	
	for ($i = 1; $i <= $data->sheets[0]['numRows']; $i++) {
	
		$value[0] = $data->sheets[0]['cells'][$i][1];
		$str = $value[0];
		$str_sec = explode("]",$str);
		$count_array = count($str_sec);
		
		$file = "str_sec1.csv";
		$fp = fopen($file, 'w');
		$str_sec3 = array();
		$str_array = array();
		$str_array[0] = $value[0];
		
		for($x=1; $x<$count_array; $x++){
			
			$str_sec2 = explode(",",$str_sec[$x]);

			$str_array[$x] = $str_sec2[0];
			
			
			}
		//fputcsv($fp, $str_array);
		//$n_array = array("\r\n");
		fputcsv($fp, $str_array);
		//fputcsv($fp, $n_array);
		
		//echo $i."　　　".$value[0]."<br>";
	}  
	 

	
	
	fclose($fp);

	


?>