<?php

  echo "<title>拆出二洋要的字串</title>";
  echo "<br>【拆出二洋要的字串】<br>";
  echo "<br>";
  echo "<form action='preg.php' method='get'>";
  echo "　　請輸入要拆解的字串: <input type='text' name='N' />";
  echo "<input type='submit' />";
  echo "</form>";
  
  
 

    //判斷值是否輸入
	if(isset($_GET['N']))
	{
	$str = $_GET['N'];

	//$str = "[Chung, Ming-Shun; Lin, Yu-Chung; Lin, Chieh-Nan; Chang, Fang-Rong; Shen, Shu-hua; Ouyang, Wen-Chen] Jianan Mental Hosp, Tainan, Tainan County, Taiwan; [Yang, Albert C.] Taipei Vet Gen Hosp, Dept Psychiat, Taipei, Taiwan; [Yang, Albert C.] Natl Cent Univ, Ctr Dynam Biomarkers & Translat Med, Chungli 32054, Taiwan; [Yang, Albert C.; Chiu, Hsien-Jane] Natl Yang Ming Univ, Div Psychiat, Sch Med, Taipei 112, Taiwan; [Chiu, Hsien-Jane] Min Sheng Gen Hosp, Tao Yuan, Taiwan";

	$str_sec = explode("]",$str);

	$count_array = count($str_sec);

	
	
	$file = "D:/str_sec.csv";
	$fp = fopen($file, 'w');
	$str_sec3 = array();
	$str_array = array();
	
	for($i=1; $i<$count_array; $i++){
		
		$str_sec2 = explode(",",$str_sec[$i]);
		//echo $str_sec2[0]."<br>";
		
		//$str_test = array($str_sec2[0]);
		
		//array_push($str_sec3, $str_test);
		
		$str_array[$i-1] = $str_sec2[0];
		

	}
	
	//$row = array();
	//$row[0] = "111";
	//$row[1] = "222";

	//print_r($str_sec3);
	fputcsv($fp, $str_array);
	
	//print_r($array_to_csv);
	//echo $str_sec3;
	
	fclose($fp);

	
}

?>