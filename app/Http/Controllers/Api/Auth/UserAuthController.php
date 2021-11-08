<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Transformers\Common\ErrorTransformer;
use App\Transformers\Users\LoggedInUserTransformer;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Throwable;

class UserAuthController extends Controller
{
    public function login(Request $request)
    {

        $data = $request->validate([
            'email' => 'email|required',
            'password' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();
        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                return fractal($user, new LoggedInUserTransformer())->respond(200);
            } else {
                return $this->sendErrorResponse('Password mismatch');
            }
        } else {
            return $this->sendErrorResponse('User does not exist');
        }
    }

    /* user logout */
    public function logout()
    {
        try {
            $accessToken = Auth::user()->token();
            DB::table('oauth_refresh_tokens')->where('access_token_id', $accessToken->id)
                ->update([
                    'revoked' => true
                ]);

            $accessToken->revoke();
            return $this->sendResponse([], 'User logout successfully.');
        } catch (Throwable $e) {
            return $this->sendError($e->getMessage(), $e->getCode());
        }
    }
}
