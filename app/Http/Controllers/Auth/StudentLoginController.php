<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Events\LoginLogoutActivityEvent; 
use Auth;
use Route;

class StudentLoginController extends Controller
{
    public function __construct()
    {
      $this->middleware('guest:student', ['except' => ['logout']]);
    }

    

    public function showStudentLoginForm()
    {
        return view('welcome');
    }
    
    public function login(Request $request)
    {
        //dd($request->all());
      // Validate the form data
      $this->validate($request, [
        'matric_no'   => 'required|min:6',
        'password' => 'required|min:6'
      ]);
      

      
      // Attempt to log the user in
      if (Auth::guard('student')->attempt(['matric_no' => $request->matric_no, 'password' => $request->password], $request->remember)) {
        // if successful, then redirect to their intended location
        
        // event(new LoginLogoutActivityEvent($request->matric_no));
        return redirect()->intended(route('student.dashboard'));
      } 
      // if unsuccessful, then redirect back to the login with the form data
      return redirect()->back()->withInput($request->only('matric_no', 'remember'));
    }
    
    public function logout()
    {
        Auth::guard('student')->logout();
        return redirect('/studentLogin');
    }
    
}

