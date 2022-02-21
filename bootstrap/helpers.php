<?php

	function time_elapsed_string($datetime, $full = false) {
		
		$milliseconds_ago = 1000 * strtotime($datetime);
		$milliseconds_now = 1000 * strtotime(date('y-m-d'));
		
		if($milliseconds_ago > $milliseconds_now){
			return date('Y/F/d', strtotime($datetime));
		}else{
			$now = new DateTime;
			$ago = new DateTime($datetime);
			$diff = $now->diff($ago);
			$diff->w = floor($diff->d / 7);
			$diff->d -= $diff->w * 7;

			$string = array(
				'y' => 'سال',
				'm' => 'ماه',
				'w' => 'هفته',
				'd' => 'روز',
				'h' => 'ساعت',
				'i' => 'دقیقه',
				's' => 'ثانیه',
			);
			foreach ($string as $k => &$v) {
				if ($diff->$k) {
					$v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? '' : '');
				} else {
					unset($string[$k]);
				}
			}
			if (!$full) $string = array_slice($string, 0, 1);
			return $string ? implode(', ', $string) . ' قبل' : 'تازه';
		}
		
	}
   

?>