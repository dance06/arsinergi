<?php
function jsAlert($string){
	$js ="<script type='text/javascript'>";
	$js.="alert('".$string."');";
	$js.="</script>";
	return $js;
}

function convertToMinutes($second){

	return round($second/60)."m ".($second%60)."s";
}
function convertToRp($price){
	$a = '<table width="100%"><tr><td>Rp.</td><td align="right" class="price-field">'.number_format($price, 0, ",",".").'</td></tr></table>';
	return $a;
	//return "Rp. ".number_format($price, 0, ",",".");
}

function convertToRp1($price){
	$a = '<table width="100%"><tr><td>Rp.</td><td align="right" class="price-field-indent">'.number_format($price, 0, ",",".").'</td></tr></table>';
	return $a;
	//return "Rp. ".number_format($price, 0, ",",".");
}
function convertToDateID($dates, $format="dd mmm YYYY"){
	//$dates yyyy-mm-dd
	$date=substr($dates, 8,2);
	$month=substr($dates, 5,2);
	$year=substr($dates, 0,4);

	if($format=="dd mmm YYYY"){
		switch($month){
			case '01': $month="Jan"; break;
			case '02': $month="Feb"; break;
			case '03': $month="Mar"; break;
			case '04': $month="Apr"; break;
			case '05': $month="Mei"; break;
			case '06': $month="Jun"; break;
			case '07': $month="Jul"; break;
			case '08': $month="Ags"; break;
			case '09': $month="Sep"; break;
			case '10': $month="Okt"; break;
			case '11': $month="Nov"; break;
			case '12': $month="Des"; break;
		}
		return $date." ".$month." ".$year;
	}
}
function convertDate($dates){
	//$dates dd-mm-yyyy
	$date=substr($dates, 0,2);
	$month=substr($dates, 3,2);
	$year=substr($dates, 6,4);

	return $year."-".$month."-".$date;

}
function calc1($str){
	eval("\$str = $str;");
	return $str;
}
function calc2($str){
	$fn= create_function("", "return ({$str});");
	return $fn;
}

function array_sort_by_column(&$array, $column, $direction = SORT_ASC) {
    $reference_array = array();

    foreach($array as $key => $row) {
        $reference_array[$key] = $row[$column];
    }

    array_multisort($reference_array, $direction, $array);
}
?>
