<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Collection;

class ItemController extends Controller
{
    public function itemList(){

        $csv_path = storage_path('data' . DIRECTORY_SEPARATOR . 'items.csv');
        $data = parse_data($csv_path);

        return response()
            ->json($data,200);
    }
}
