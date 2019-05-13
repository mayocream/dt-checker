<?php

namespace Dt;

class dateHandle {

	public static function handleData($dataArray) {
		$data = [];
		foreach ($dataArray as $date) {
			$match = explode('-', $date);
			$year = $match[1];
			$month = $match[2];
			$day = $match[3];
			if (!isset($data[$year])) {
				$data[] = (int)$year;
			}
			if (!isset($data[$year][$month])) {
				$data[$year][] = (int)$month;
			}
			$data[$year][$month][] = (int)$day;
		}
		return $data;
	}

}