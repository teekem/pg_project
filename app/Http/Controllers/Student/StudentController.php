<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Rules\CourseRegistrationRule;
use App\Models\Setting;
use App\Models\Course;
use App\Models\Student;
use Illuminate\Support\Facades\DB;
use Image;
use Illuminate\Support\Facades\Hash;
class StudentController extends Controller
{
    //


   public function __construct()
    {
      $this->middleware('auth:student');
    }


      public function settings()
      {
        return DB::table('settings')->where('status', 1)->first();
      }

    public function index()
    {
        return view('studentHome');
        //return User::latest()->paginate(5);
    }

    public function sProfile()
    {
      return auth('student')->user();
    }

    public function updateProfile(Request $request)
    {
      
      $user = auth('student')->user();
      //dd($user->photo);
      // $this->validate($request,[
      //     'name'         => 'required|string|max:191',
      //     'email'        => 'required|string|email|max:191|unique:users,email,'. $user->id,
      //     'password'     => 'sometimes|string|min:6',
      //    ]);
      
      $currentPhoto = $user->photo;
      if($request->photo != $currentPhoto ){
          $name = time(). '.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];
         // return $name;
         Image::make($request->photo)->save(public_path('/images/student/'). $name);
          
        $request->merge(['photo' => $name]);
        
        $userPhoto = public_path('/images/student/'). $currentPhoto;
        if(file_exists($userPhoto)){
            @unlink($userPhoto);
        }
      }
      if(!empty($request->password)){
          $request->merge(['password' => Hash::make($request->password)]);
      }
      
      $user->update($request->all());
      return ['message' => 'Profile successfully updated'];
    }


      // *********Course Registration ******************************** //
    public function available_courses_for_registration_for_this_semester()
    {

      //dd(Auth::user()->id, Auth::user()->programme_id, Auth::user()->matric_no, Auth::user()->level,
      //$this->settings()->semester_id );
      $student_programme_id = Auth::user()->programme_id;
      $student_id = Auth::user()->id;
      $matric_no = Auth::user()->matric_no;
      $student_level = Auth::user()->level;
      $courses_for_reg = DB::table('courses')
      ->select('courses.course','courses.course_code', 'courses.unit', 'course_programme.status','courses.course_id')
      ->join('course_programme', 'course_programme.course_id', '=', 'courses.course_id')
      ->where('course_programme.level', $student_level)
      ->where('course_programme.programme_id', $student_programme_id)
      ->where('course_programme.semester_id', $this->settings()->semester_id)
      ->get();

      $carryover_courses = DB::table('course_outstanding')
      ->select('course_outstanding.id','course_outstanding.matric_no',
       'course_outstanding.course_id','course_outstanding.semester_id', 
       'course_outstanding.status', 'courses.unit','courses.course','courses.course_code')
      ->join('courses', 'courses.course_id', '=', 'course_outstanding.course_id' )
      ->join('course_programme', 'course_programme.course_id', '=', 'courses.course_id')
      ->where('course_outstanding.matric_no', $matric_no)
      ->where('course_outstanding.status','F')
      ->where('course_programme.semester_id', $this->settings()->semester_id)
      ->get();

      $submit_update = DB::table('course_student')
      ->where('matric_no',$matric_no )
      ->where('student_id', $student_id)
      ->where('setting_id',$this->settings()->id )
      ->count();
      $reg_course = ['db_norm_courses' =>  $courses_for_reg,'db_carryover_courses' => $carryover_courses, 'db_submit_update' => $submit_update];

      return $reg_course;

        //return view('courseReg', compact('courses_for_this_programme_for_this_student_for_this_semester'));
    }


  public function registerCourse(Request $request)
  {
    
    $student_id = Auth::user()->id;
    $matric_no = Auth::user()->matric_no;
    $student_level = Auth::user()->level;

    $reg_course_id = [];
    $reg_course_unit = [];
    $reg_course_status = [];
    foreach($request->reg_courses as $course_id){
    array_push($reg_course_id , $course_id['course_id'] ) ;
   }
    foreach($request->reg_courses as $course_unit){
    array_push($reg_course_unit , $course_unit['unit'] ) ;
   }
    foreach($request->reg_courses as $course_status){
    array_push($reg_course_status, $course_status['status'] ) ;
   }
         //dd( $reg_course_unit);
        $request->validate([
            'reg_courses' => ['required', new CourseRegistrationRule()]
       ]);

    if (!is_null($request->reg_courses) ) {

          $x = 0;
        foreach ($reg_course_id  as $key => $course_id) {
          Student::findOrFail($student_id)->courses()->attach($course_id, [
            'matric_no' => $matric_no, 'setting_id'=> $this->settings()->id,
            'course_status'=> $reg_course_status[$x], 'unit'=>  $reg_course_unit[$x],
            'reg_level' => $student_level 
          ]);
          $x +=1;
        }

        return 'Course Registration Successful!';
        }

    else{
      return "Failed";
    }


  }
  public function updateCourseRegistration(Request $request)
  {
    $student_id = Auth::user()->id;
    $matric_no = Auth::user()->matric_no;
    $student_level = Auth::user()->level;

    $reg_course_id = [];
    $reg_course_unit = [];
    $reg_course_status = [];
    foreach($request->reg_courses as $course_id){
    array_push($reg_course_id , $course_id['course_id'] ) ;
   }
    foreach($request->reg_courses as $course_unit){
    array_push($reg_course_unit , $course_unit['unit'] ) ;
   }
    foreach($request->reg_courses as $course_status){
    array_push($reg_course_status, $course_status['status'] ) ;
   }
         //dd( $reg_course_unit);
        $request->validate([
            'reg_courses' => ['required', new CourseRegistrationRule()]
       ]);

    if (!is_null($request->reg_courses) ) {
          $x = 0;
          $student =  Student::findOrFail($student_id);
           DB::table('course_student')
           ->where('student_id', $student_id)
           ->where('setting_id', $this->settings()->id )
           ->where('matric_no', $matric_no)
           ->where('reg_level',$student_level )
           ->delete();
       
        foreach ($reg_course_id  as $key => $course_id) {
          $student->courses()->attach($course_id, [
            'matric_no' => $matric_no,'setting_id'=> $this->settings()->id,
            'course_status'=> $reg_course_status[$x], 'unit'=>  $reg_course_unit[$x],
            'reg_level' => $student_level 
          ]);
          $x +=1;
        }

        return 'Course Registration updated Successful!';
        }

    else{
      return "Failed";
    }


  }


  //*************************************  Course registration ends ********************************//



 public function fileProcess()
    {
      return view('fileProcess');
    }


}





