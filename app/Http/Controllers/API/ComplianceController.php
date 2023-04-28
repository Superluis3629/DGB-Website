<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Compliance;

class ComplianceController extends Controller
{
    //
    public function add(Request $request)
    {
        try {

            if($request->file('file')) {
                $upload_path = "asset/img";
                $generate_new_name = time().'.'.$request->file->getClientOriginalExtension();
                $request->file->move(public_path($upload_path),$generate_new_name);

                $compliance = new Compliance();     
                $compliance->recipient = $request->recipient;
                $compliance->type_of_report = $request->type_of_report;
                $compliance->title = $request->title;
                $compliance->company = $request->company;
                $compliance->department = $request->department;
                $compliance->name = $request->name;
                $compliance->date_time = $request->date_time;
                $compliance->place_of_the_event = $request->place_of_the_event;
                $compliance->detail_of_event = $request->detail_of_event;
                $compliance->image = $generate_new_name;
                $compliance->mention_anyone = $request->mention_anyone;
                $compliance->feel_free = $request->feel_free;
                $compliance->problem_happen = $request->problem_happen;
                $compliance->problem_has_lasted = $request->problem_has_lasted;
                $compliance->save();
            }else{
                $compliance = new Compliance();     
                $compliance->recipient = $request->recipient;
                $compliance->type_of_report = $request->type_of_report;
                $compliance->title = $request->title;
                $compliance->company = $request->company;
                $compliance->department = $request->department;
                $compliance->name = $request->name;
                $compliance->date_time = $request->date_time;
                $compliance->place_of_the_event = $request->place_of_the_event;
                $compliance->detail_of_event = $request->detail_of_event;
                $compliance->mention_anyone = $request->mention_anyone;
                $compliance->feel_free = $request->feel_free;
                $compliance->problem_happen = $request->problem_happen;
                $compliance->problem_has_lasted = $request->problem_has_lasted;
                $compliance->save();
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

}
