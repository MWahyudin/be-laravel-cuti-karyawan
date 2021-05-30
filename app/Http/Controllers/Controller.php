<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function RequestSuccess($data)
    {
        return response()->json(['message' => 'Successfully', 'data' => $data], 200);
        # code...
    }

    public function RequestFailed()
    {
        return response()->json(['message' => 'Failed !', 'data' => null], 500);
        # code...
    }

    public function Unauthhorized()
    {
        return response()->json(['message' => 'You do not have permission to access thi data',], 403);
        # code...
    }
}
