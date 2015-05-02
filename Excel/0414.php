<?php

require_once 'reader.php';

  echo "<title>計算關鍵字出現次數</title>";
  echo "<br>【計算關鍵字出現次數】<br>";
  echo "<br>";
  echo "<form action='0414.php' method='get'>";
  echo "　　請輸入要搜尋的字串: <input type='text' name='N' />";
  echo "<input type='submit' />";
  echo "</form>";

	if(isset($_GET['N']))
	{
  
	$data = new Spreadsheet_Excel_Reader();
	$data->setOutputEncoding('UTF-8');
	$data->read('0414all.xls');
	error_reporting(E_ALL ^ E_NOTICE);
	//set_time_limit(0);
	
	$id_array = array();
	$str_count = 0;
	$str[0] = $_GET['N'];
	//$str = $_GET['N'];
	
	$file = "tmp/file".date('Y_m_d_H_i_s').".csv";
	$fp = fopen($file, 'w');
	$str_array = array();
	$index_array = array();
	/*for($x = 1; $x <=21; $x++){
	
		$head[$x-1] = $data->sheets[0]['cells'][1][$x];
				
	}
	fputcsv($fp, $head);*/
	
	
	for ($i = 1; $i <= $data->sheets[0]['numRows']; $i++) {
		for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
			
			$value[$j-1] = $data->sheets[0]['cells'][$i][$j];
		
		}
		
		
		if(strpos($value[17], $str[0])!== false){
			
			//fputcsv($fp, $value);

			if(array_key_exists($value[0], $id_array)){

			}else{
				$str_count++;
				$id_array[$value[0]] = "USED";
				echo "　　➔　　　已搜尋到".$str_count."筆資料<br>";
				array_push($index_array, $value[0]);
				
				

			}
		}
		
		
		
	
	}  

	echo "<br>　　➔　　　".$str[0]."總共出現次數：".$str_count;

	echo "<br>　　➔　　　開始匯出excel";
	
	for ($i = 1; $i <= $data->sheets[0]['numRows']; $i++) {
		for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
			
			$value[$j-1] = $data->sheets[0]['cells'][$i][$j];
		
		}
			if(in_array($value[0], $index_array)){
			fputcsv($fp, $value);	}
			else{}
		}

	echo "<br>　　➔　　　匯出完成";
	fclose($fp);
	echo "<br>　　➔　　　關閉連線";
	}


?>