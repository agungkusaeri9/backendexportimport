<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Finance;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FinanceController extends Controller
{
    public function search()
    {
        $validator = Validator::make(request()->all(),[
            'job_number' => ['required']
        ]);

        if($validator->fails())
        {
            return response()->json($validator->errors());
        }
        $job_number = request('job_number');
        if($job_number)
        {
            $finance = Finance::with('warehouse','carrier','portofloading','dst')->where('job_number',$job_number)->first();
            if($finance)
            {
                $data = [
                    'code' => 200,
                    'status' => true,
                    'message' => 'Finance ditemukan!',
                    'data' => $finance
                ];
            }else{
                $data = [
                    'code' => 404,
                    'status' => true,
                    'message' => 'Finance dengan job number tersebut tidak ditemukan!',
                    'data' => $finance
                ];
            }
        }else{
            $data = [
                'code' => 400,
                'status' => false,
                'message' => 'Invalid Request!',
                'data' => NULL
            ];
        }

        return response()->json($data);
    }
}
