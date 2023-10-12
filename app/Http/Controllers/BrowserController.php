<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BrowserStat;

class BrowserController extends Controller
{
	public function index()
	{
		$browsers = BrowserStat::all();
		$dataPoints = [];
		foreach ($browsers as $browser) {
			$dataPoints[] = [
				"name" => $browser['name'],
				"y"    => floatval($browser['total_usage'])
			];
		}
		return view("chart.pie-chart", [
			"data" => json_encode($dataPoints)
		]);
	}
}
