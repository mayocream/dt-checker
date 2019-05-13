<?php

namespace Dt;

class dateHandle {

	public static function handleData($dataArray) {
		$data = [];
		foreach ($dataArray as (string)$date) {
			$match = explode('-', $date);
			$year = $match[0];
			$month = $match[1];
			$day = $match[2];
			if (!isset($data[$year])) {
				$data[] = $year;
				$data[$year] = [];
			}
			if (!isset($data[$year][$month])) {
				$data[$year][] = $month;
				$data[$year][$month] = [];
			}
			$data[$year][$month][] = $day;
		}
		return $data;
	}

}