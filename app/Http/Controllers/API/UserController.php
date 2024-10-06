<?php

namespace App\Http\Controllers\API;

use App\Helpers\CommonHelper;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function pendingUsers(Request $request)
    {
        $pendingUsers = User::where('customer_type', 1)->whereIn('status', [2, 3])->with('b2b_details', 'b2c_details', 'salesChannel')->get();
        return CommonHelper::responseSuccessWithData("Pending user list fetched", $pendingUsers);
    }

    public function verifyUser(Request $request)
    {
        $validate = validator($request->all(), [
            'user_id' => 'required|exists:users,id'
        ]);
        if ($validate->fails()) {
            return response()->json(['status' => 0, 'message' => 'Validation failed', 'data' => [], 'errors' => $validate->errors()->messages()]);
        }
        $user = User::where('customer_type', 1)->where('id', $request->user_id)->with('b2b_details', 'b2c_details', 'salesChannel')->first();
        if ($user) {
            $userUpdate = User::find($request->user_id);
            $userUpdate->status = 1;
            $userUpdate->save();
            return CommonHelper::responseSuccessWithData('User account approved', $user);
        } else {
            return CommonHelper::responseError("Invalid user selection");
        }
    }
}
