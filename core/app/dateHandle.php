<?php

namespace Dt;

class dateHandle {

	public static function handleData($dataArray) {
		$data = [];
		foreach ($dataArray as $date) {
			$match = explode('-', $date);
			$year = $match[0];
			$month = $match[1];
			$day = $match[2];
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