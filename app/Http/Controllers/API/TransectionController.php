<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Transection;
use App\Models\Store;
use App\Models\Bills;
use App\Models\BillsList;

class TransectionController extends Controller
{
    //
    public function add(Request $request) {
        try {
            //ວົນລູບ ບັນທຶກແຕ່ລະລາຍການ
            foreach($request->listOrder as $item) {

                $number = '';
                $tran = Transection::all()->sortByDesc('id')->take(1)->toArray();

                foreach($tran as $new) {
                    $number = $new["tran_id"]; //INC00001
                }
                //ຕົວຢ່າງ INC00001
                if($number != '') {
                    $number1 = str_replace("INC","",$number); //00001
                    $number2 = str_replace("EXP","",$number1);
                    $number3 = (int)$number2+1; // 1+1 = 2
                    $length = 5;
                    $number = substr(str_repeat(0,$length).$number3, -$length); //00002
                } else {
                    $number = 1;
                    $length = 5;
                    $number = substr(str_repeat(0,$length).$number, -$length); //00002
                }

                //ກວດສອບປະເພດທຸລະກຳ
                if ($request->acc_type == "income") {
                    $tnum = "INC"; //INC
                } elseif($request->acc_type == "express") {
                    $tnum = "EXP"; //EXP
                }

                $result = New Transection();
                $result->tran_id = $tnum.$number; //INC00002, EXP00002
                $result->product_id = $item['id'];
                $result->tran_type = $request->acc_type;
                $result->amount = $item['order_amount'];
                $result->price = $item['order_amount']*$item['price_sell'];
                $result->tran_detail = $item['name'];
                $result->save();

                //ຕັດສະຕ໊ອກສິນຄ້າ
                $store = Store::find($item['id']);
                $store_update = Store::find($item['id']);
                $store_update->update([
                    'amount'=>$store->amount - $item['order_amount'],
                ]);
            }
            $success = true;
            $message = "ບັນທຶກຂໍ້ມູນສຳເລັດ!";
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
            $number_bill = '';
        }
        $response = [
            "success" => $success,
            "message" => $message
        ];
        return response()->json($response);
    }
}
