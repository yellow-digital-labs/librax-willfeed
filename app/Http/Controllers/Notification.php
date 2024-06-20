<?php

namespace App\Http\Controllers;

use App\Models\SystemNotification;
use Illuminate\Http\Request;
use Auth;

class Notification extends Controller
{
    public function read(Request $request, $id)
    {
        if(Auth::user()){
            SystemNotification::where(['id' => $id])->update([
                'is_read' => 1
            ]);
    
            return response()->json([
                "message" => "Notification read successfully",
                "code" => 200,
                "data" => [],
            ]);
        } else {
            return response()->json([
                "message" => "You do not have access",
                "code" => 500,
                "data" => [],
            ]);
        }
    }
}
