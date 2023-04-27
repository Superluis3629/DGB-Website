<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Store;
use PhpParser\Node\Expr\FuncCall;

class StoreController extends Controller
{
    //
    public function index()
    {
        $search = \Request::get('s');

        // $store = Store::orderBy('id', 'asc')
        // ->where('name','LIKE',"%{$search}%")
        // ->get();

    
            $store = Store::orderBy('id', 'asc')
            ->where('name','LIKE',"%{$search}%")
            ->paginate(20)
            ->toArray();
    
 
        
 
        return array_reverse($store);
    }

    public function add(Request $request)
    {
        try {

            if($request->file('file')) {
                $upload_path = "asset/img";
                $generate_new_name = time().'.'.$request->file->getClientOriginalExtension();
                $request->file->move(public_path($upload_path),$generate_new_name);

                $store = new Store();
                $store->name = $request->name;
                $store->image = $generate_new_name;
                $store->amount = $request->amount;
                $store->price_buy = $request->price_buy;
                $store->price_sell = $request->price_sell;
                $store->save();
            }else{
                $store = new Store();
                $store->name = $request->name;
                $store->amount = $request->amount;
                $store->price_buy = $request->price_buy;
                $store->price_sell = $request->price_sell;
                $store->save();
            }

            $success = true;
            $message = "ບັນທຶກຂໍ້ມູນສຳເລັດ!";
        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }
        $response = [
            "success" => $success,
            "message" => $message
        ];
        return response()->json($response);
    }

    public function edit($id)
    {
        $store = Store::find($id);
        return $store;
    }

    public function update($id, Request $request)
    {
        try {
            $store = Store::find($id);
            $upload_path = "asset/img";
            //ກວດສອບວ່າຮູບໄດ້ອັບໂຫຼດຫຼືບໍ່
            if ($request->file('file')) {
                //ລົບຮູບພາບເກົ່າ
                if($store->image) {
                    if(file_exists($upload_path.'/'.$store->image)) {
                        unlink($upload_path.'/'.$store->image);
                    }
                }
                $generate_new_name = time().'.'.$request->file->getClientOriginalExtension();
                $request->file->move(public_path($upload_path),$generate_new_name);
                $store->update([
                    'name'=> $request->name,
                    'image'=> $generate_new_name,
                    'amount'=> $request->amount,
                    'price_buy'=> $request->price_buy,
                    'price_sell'=> $request->price_sell,
                ]);
            } else {
                if ($request->file) {
                    $store->update([
                        'name'=> $request->name,
                        // 'image'=> $generate_new_name,
                        'amount'=> $request->amount,
                        'price_buy'=> $request->price_buy,
                        'price_sell'=> $request->price_sell,
                    ]);
                } else {
                    if($store->image) {
                        if(file_exists($upload_path.'/'.$store->image)) {
                            unlink($upload_path.'/'.$store->image);
                        }
                    }
                    $store->update([
                        'name'=> $request->name,
                        'image'=> '',
                        'amount'=> $request->amount,
                        'price_buy'=> $request->price_buy,
                        'price_sell'=> $request->price_sell,
                    ]);
                }
            }

            $success = true;
            $message = "ອັບເດດຂໍ້ມູນສຳເລັດ!";

        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }
        $response = [
            "success" => $success,
            "message" => $message
        ];
        return response()->json($response);
    }

    public function delete($id) {
        try {
            $store = Store::find($id);
            $store->delete();

            $success = true;
            $message = "ລົບຂໍ້ມູນສຳເລັດ!";

        } catch (\Illuminate\Database\QueryException $ex) {
            $success = false;
            $message = $ex->getMessage();
        }
        $response = [
            "success" => $success,
            "message" => $message
        ];
        return response()->json($response);
    }
}
