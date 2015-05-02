<?php

require_once 'reader.php';

  echo "<title>計算學校與科系出現次數</title>";
  
  echo "<style>h { color: red; font-style: italic; font-weight: 900;}</style>";
  
  echo "<br>【計算學校與科系出現次數】<br>";
  echo "<br>";
  echo "<form action='0421_inputfile_dep_no.php' method='get'>";
  echo "　　請選擇要輸入的檔案: <input type='file' name='F'>";
  echo "<br>";
  echo "<br>";
  echo "　　請輸入要搜尋的科系: <input type='text' name='D' /> <h>（如不使用則不輸入即可）</h>";
  echo "<br>";
  echo "<br>";
  echo "　　<input type='submit' />";
  echo "</form>";
  
  

	if(isset($_GET['D']))
	{
	$file_name = $_GET['F'];
	$data = new Spreadsheet_Excel_Reader();
	$data->setOutputEncoding('UTF-8');
	//$data->read('0414all.xls');
	echo "　　➔　　　匯入檔案為:".$file_name."<br><br>";
	$data->read($file_name);
	error_reporting(E_ALL ^ E_NOTICE);
	//set_time_limit(0);
	
	$id_array = array();
	$id_array2 = array();
	$str_count = 0;
	$str_count2 = 0;
	$str[0] = $_GET['N'];
	//$str = $_GET['N'];
	$str[1] = $_GET['D'];
	
	$file = "tmp/file".date('Y_m_d_H_i_s').".csv";
	$fp = fopen($file, 'w');
	$str_array = array();
	$str_array2 = array();
	$index_array = array();
	$index_array2 = array();
	/*for($x = 1; $x <=21; $x++){
	
		$head[$x-1] = $data->sheets[0]['cells'][1][$x];
				
	}
	fputcsv($fp, $head);*/
	
	
	for ($i = 1; $i <= $data->sheets[0]['numRows']; $i++) {
		for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
			
			$value[$j-1] = $data->sheets[0]['cells'][$i][$j];

		}
		
		if(strpos($value[4], $str[1])!== false){


				if(array_key_exists($value[0], $id_array)){

				}else{
					$str_count++;
					$id_array[$value[0]] = "USED";
					echo "　　➔　　　學校『".$str[0]."』已搜尋到".$str_count."筆資料<br>";
					
					array_push($index_array, $value[0]);
					
					

				}
			
		}


	
	}  
	
	echo "<br>　　➔　　　".$str[1]."總共出現次數：".$str_count;
	if($str_count2 != 0){
	echo "<br>　　➔　　　其中領域為".$str[1]."則出現次數為：".$str_count2;


	echo "<br>　　➔　　　開始匯出excel";
	
	for ($i = 1; $i <= $data->sheets[0]['numRows']; $i++) {
		for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
			
			$value[$j-1] = $data->sheets[0]['cells'][$i][$j];
		
		}
			if(in_array($value[0], $index_array2)){
			fputcsv($fp, $value);	}
			else{}
		}
	}else{
		echo "<br>　　➔　　　開始匯出excel";
	
	for ($i = 1; $i <= $data->sheets[0]['numRows']; $i++) {
		for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
			
			$value[$j-1] = $data->sheets[0]['cells'][$i][$j];
		
		}
			if(in_array($value[0], $index_array)){
			fputcsv($fp, $value);	}
			else{}
		}
	}
	echo "<br>　　➔　　　匯出完成";
	fclose($fp);
	echo "<br>　　➔　　　關閉連線";
	}




?>