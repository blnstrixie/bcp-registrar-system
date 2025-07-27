<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\Models\User;

class AuthController extends Controller
{
    public function show_login() {
        if(Auth::check()) {
            return redirect()->route('user.dashboard');
        }
        return view('auth.login');
    }
    public function attempt_login(Request $request) {
        $this->validate($request, [
            "username" => "required",
            "password" => "required"
        ]);

        try {
            $fieldType = filter_var($request->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
            $user = User::where([
                        $fieldType => $request['username'],
                        'password' => $request['password'],
                        'deleted_at' => null
                    ])->first();
                if ($user) {
                    Auth::login($user);

                    return redirect()->route('user.dashboard');
                }
            Session::flash("error", "Invalid Credentials");
            return redirect()->back()->withInput($request->only('username'));;
        }
        catch (ValidationException $ex) {
            return response()->json(['errors'=>$ex->errors()], 422);
        }
        catch (\Throwable $th) {
            $errorCode = $th->getCode();
            if($errorCode == "42S02") {
                return "Base table or view not found. Kindly check your database.";
            }
            return response()->json(['error'=>$th->getMessage()], 500);
        }
    }
    // LOGOUT FUNCTION
    public function logout(Request $request) {
        try {
            Auth::logout();
            $request->session()->flush();
            $request->session()->regenerate();

            return redirect()->route('index');

        } catch (\Throwable $th) {
            return redirect()->route('index');
        }
        catch (\Exception $ex) {
            die($ex->getMessage());
        }
    }
}
