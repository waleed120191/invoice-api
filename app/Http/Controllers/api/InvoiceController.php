<?php

namespace App\Http\Controllers\api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Rules\ValidateItems;
use Symfony\Component\Console\Input\Input;

class InvoiceController extends Controller
{
    public function calculateInvoice(Request $request)
    {
        //print_debug($request->all());

        $validator = \Validator::make($request->all(), [
            'lines' => ['required', new ValidateItems]
        ]);

        if ($validator->fails()) {
            $message = '';

            $errors = $validator->errors();
            foreach ($errors->all() as $m) {
                $message .= $m . '\n';
            }

            return response()
                ->json(['id' => 400, 'message' => $message], 400);

        } else {
            $lines = $request->all();

            $csv_path = storage_path('data' . DIRECTORY_SEPARATOR . 'items.csv');
            $data = parse_data($csv_path);
            $data = id_to_index($data);

            $lines_return = [];
            $total = 0.00;
            $tax = 0.0000;

            foreach ($lines['lines'] as $k => $l){

                $total_price = ($data[$l['id']]['price'] * $l['quantity']);
                $total_discount = ($total_price * $l['discount'])/100;
                $total_after_discount = $total_price - $total_discount;
                $tax += $data[$l['id']]['tax'];
                $total += $total_after_discount;

                if(isset($data[$l['id']])){
                    $lines_return[] = [
                        'id' => $data[$l['id']]['id'],
                        "name" => $data[$l['id']]['name'],
                        "quantity" => $l['quantity'],
                        "discount" => $l['discount'],
                        "tax_rate" => $data[$l['id']]['tax'],
                        "total" => $total_after_discount
                    ];
                }

            }

            return response()
                ->json(['lines' => $lines_return, 'tax' => $tax, 'total' => $total + $tax], 200);
        }



        die('2');

    }
}
