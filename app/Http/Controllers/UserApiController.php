<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\UserApi;

use Illuminate\Support\Facades\DB;
use Mockery\Exception;

class UserApiController extends Controller
{
    public function postUser(Request $request) {
        try {
            $name = $request->name;
            $email = $request->email;
            $password = $request->password;

            $route = DB::table('setup_route')->select('region', 'sr_name', 'sr_level')->first();

//        $incident_type = New IncidentType;
//        $incident_type->incident_name = $incident_name;
//        $incident_type->type = $incident_type;
//        $incident_type->save();


            $final_result = new \stdClass();
            $final_result->success = true;

            $result = new \stdClass();
            $result->user_id = 1;
            $result->full_name = $name;
            $result->route = $route;

            $final_result->data = $result;

            DB::table('users')->insert(
                ['name' => $name,
                    'email' => $email,
                    'password' => $password
                ]
            );


            //$data = (object) $route;
            $response = [];
            $response['status'] = "Success";
            $response['code'] = 200;
            $response['data'] = $final_result;
            return response()->json($response, 302);

        } catch (\Exception $e) {
            $response = [];
            $response['status'] = "Error";
            $response['code'] = 302;
            $response['message'] = $e->getMessage();
            return response()->json($response, 302);
        }
    }
}


