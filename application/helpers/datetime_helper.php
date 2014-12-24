<?php

/**
* 输出格式化后的出团时间(星期几):
*/
if ( ! function_exists('datetime_print_weekdays')){

	function datetime_print_weekdays($str){
		if($str == ''){
			return '';
		}
		$WEEKDAYS = array(
			'星期一',
			'星期二',
			'星期三',
			'星期四',
			'星期五',
			'星期六',
			'星期日'
		);
		$array = explode(",",$str);
		foreach($array as &$value){
			$value = $WEEKDAYS[$value];
		}
		$result = '( ';
		$result .= implode(' , ',$array);
		$result .= ' )';
		return $result;
	}
	
}

/**
* 输出格式化后的出团时间(几月几号至几月几号):
*/
if ( ! function_exists('datetime_print_route_dates')){

	function datetime_print_route_dates($start,$end){
		if($start=='' AND $end == ''){
			return '没有开放';
		}elseif($start != '' AND $end == ''){
			return $start;
		}elseif($start == '0000-00-00' AND $end == '9999-00-00'){
			return '任何日期';
		}elseif($start == '0000-00-00' AND $end != '9999-00-00'){
			return '现在至 '. $end;
		}elseif($start != '0000-00-00' AND $end == '9999-00-00'){
			return $start . ' 以后';
		}elseif($start != '0000-00-00' AND $end != '9999-00-00'){
			return $start . ' 至 ' . $end;
		}
		
	}
	
}