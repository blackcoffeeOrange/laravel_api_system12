<?php


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| api.php は自動で /api プレフィックスが付くので/api/loginとしない
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


/** ログイン認証 */
Route::post('/login', function (Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (!Auth::attempt($credentials)) {
        return response()->json([
            'message' => 'ログインに失敗しましたよ'
        ], 401);
    }

    /** @var \App\Models\User $user */
    $user = Auth::user();
    $token = $user->createToken('my-app-token')->plainTextToken;

    return response()->json([
        'token' => $token,
    ]);
});

/** ログイン済みユーザーの情報を返す */
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/** ログアウト */
Route::middleware('auth:sanctum')->post('/logout', function (Request $request) {
    $request->user()->currentAccessToken()->delete();
    return response()->json(['message' => 'ログアウトしました']);
});
