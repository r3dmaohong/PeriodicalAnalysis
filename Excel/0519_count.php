<?php
require_once 'reader.php';
  echo "<title>計算服務單位出現次數</title>";
  
  echo "<style>h { color: red; font-style: italic; font-weight: 900;}</style>";
  
  echo "<br>【計算服務單位出現次數】<br>";
  echo "<br>";
  echo "<form action='0519_count.php' method='get'>";
  echo "　　請選擇要輸入的檔案: <input type='file' name='F'>";
  echo "<br>";
  echo "<br>";
  echo "　　<input type='submit' />";
  echo "</form>";
  
  
	if(isset($_GET['F']))
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
	
	$all_count = 0;
	$all_count2 = 0;
	
	$str_array = array();
	$str_array2 = array();
	$index_array = array();
	$index_array2 = array();
	
	$i_dep = 0;
	$dep_name = array();
	$dep_name2 = array();
	$dep_num = array();
	$dep_index = array();
	$two_array_index = 0;
	$count_contry_one = array();
	$count_contry_one_name = array();
	
	for ($i = 2; $i <= $data->sheets[0]['numRows']; $i++) {
		for ($j = 1; $j <= $data->sheets[0]['numCols']; $j++) {
			
			$value[$j-1] = $data->sheets[0]['cells'][$i][$j];
		}
	
	//$if_exist_str = $value[0].$value[1];	
		$if_exist_str = $value[2].$value[5];	
	if(in_array($if_exist_str,$dep_name)){
		//$count_contry_one[$value[0]]++;
	}else{
			$if_exist_str2 = $value[2].$value[5];
			array_push($dep_name,$if_exist_str2);
			array_push($dep_name2,$value[5]);
			
			echo "　　➔　　　已搜尋到組別『".$value[5]."』<br>";
	
			//$count_contry_one[$value[0]]++;
			//$count_contry_one_name[$value[0]] = $value[1];
				}
	}
	@$answer = array_count_values($dep_name2);
	//print_r($answer);
	
	$dep_dep_file = "tmp/country".date('Y_m_d_H_i_s').".csv";
	$fp = fopen($dep_dep_file, 'w');
	$array_dep_array = array_unique($dep_name2);
	
	$b_array_dep_array = array_values($array_dep_array);
	
	//echo "<br>　　➔　　　共有".count($b_array_dep_array)."個";
	$array_one_index = array_keys($count_contry_one,1);
	//for($i=0;$i<count($array_one_index);$i++){
		//$answer[$count_contry_one_name[$array_one_index[$i]]] = $answer[$count_contry_one_name[$array_one_index[$i]]] - 1;
	//}
	
	for($i=0;$i<count($b_array_dep_array);$i++){
		
		if($answer[$b_array_dep_array[$i]]>0){
		$value_dep[0] = $b_array_dep_array[$i];
		$value_dep[1] = $answer[$b_array_dep_array[$i]];
		
		echo "<br>　　➔　　　".$b_array_dep_array[$i]."：".$answer[$b_array_dep_array[$i]]."次";
		
		fputcsv($fp, $value_dep);}
		else{}
	}
	echo "<br>　　➔　　　將次數匯出csv完成";
	echo "<br>　　➔　　　檔名為：".substr($dep_dep_file,4);
	fclose($fp);
	
	}
	
	
	
?>