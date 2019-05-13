<?php

namespace Dt;

class dateHandle {


	// public static function handleData($dataArray) {
	// 	$data = [];
	// 	foreach ($dataArray as $date) {
	// 		$match = explode('-', $date);
	// 		$year = $match[0];
	// 		$month = $match[1];
	// 		$day = $match[2];
	// 		if (!isset($data[$year])) {
	// 			$data[] = $year;
	// 			$data[$year] = [];
	// 			var_dump($year);
	// 		}
	// 		if (!isset($data[$year][$month])) {
	// 			$data[$year][] = $month;
	// 			$data[$year][$month] = [];
	// 			var_dump($month);
	// 		}
	// 		$data[$year][$month][] = $day;
	// 		var_dump($day);
	// 	}
	// 	return $data;
	// }

	// public function createFromData($dataArray) {
	// 	$period = [];
	// 	foreach ($dataArray as $date) {
	// 		$match = explode('-', $date);
	// 		$year = $match[0];
	// 		$month = $match[1];
	// 		$day = $match[2];
	// 		if ((int)$month >= 8) {
	// 			$school_year = $year.'-'.($year+1);
	// 			$school_period = '1';
	// 		} else {
	// 			$school_year = ($year-1).'-'.$year;
	// 			$school_period = '2';
	// 		}
	// 		if (!isset($period[$school_year])) {
	// 			$period[] = $school_year;
	// 		}
	// 		if (!isset($period[$school_year][(string)$school_period])) {
	// 			$period[$school_year] = [];
	// 			$period[$school_year][] = $school_period;
	// 			$period[$school_year][$school_period] = [];
	// 		}
	// 		$period[$school_year][$school_period][] = $date;
	// 	}
	// 	return $period;
	// }

	public static function createFromData($dataArray) {
		$period = [];
		foreach ($dataArray as $date) {
			$match = explode('-', $date);
			$year = $match[0];
			$month = $match[1];
			$day = $match[2];
			if ($month >= 8) {
				$school_year = $year.'-'.($year+1);
				$school_period = '1';
			} else {
				$school_year = ($year-1).'-'.$year;
				$school_period = '2';
			}
			$period[$school_year][$school_period][] = $date;
		}
		return $period;
	}



}