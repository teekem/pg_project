<?php

namespace App\Http\Controllers\AuthStudent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
class StudentLoginController extends Controller
{
    //

   public function __construct()
    {
        $this->middleware('guest:student', ['except'=>['logout']]);
    }


  public function showLoginForm()
    {
        return "yes";//view('studLog');
    }



    public function login(Request $request)
    {
        //Validate the form data
      $this->validate($request, [
        'matric_no' => 'required',
        'password'  => 'required|min:6'
      ]);
      //attempt to log the user in

        if (Auth::guard('student')->attempt(['matric_no' => $request->matric_no, 'password' => $request->password])) {
          // if successful then redirect to there intended location
          return redirect()->intended(route('stu.dashboard'));


        }


      // if unsuccessful redirect to the login page with form data

        return redirect()->back()->withInput($request->only(['matric_no']));
    }


    public function logout()
    {
        Auth::guard('student')->logout();
        return redirect()->route('welcome');
    }























}
