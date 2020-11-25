<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;

class NoticiaController extends Controller
{
	public function index() {
		return response()->json(DB::connection('mysql_coopunion')->table('news')
				->where('coopunion', 0)
				->where('news_state', 1)
				->orderBy('news_date', 'desc')
				->limit(9)
				->get());
	}

	public function show($id) {
		return response()->json(DB::connection('mysql_coopunion')->table('news')
				->where('coopunion', 0)
				->where('news_state', 1)
				->where('news_id', $id)
				->first());
	}


}