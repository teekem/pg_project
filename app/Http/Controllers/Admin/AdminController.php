<?php

namespace App\Http\Controllers\Admin;


use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Auth;
use App\Models\Course;
use App\Models\Session;
use App\Models\Semester;
use App\Models\Faculty;
use App\Models\Department;
use App\Models\Programme;
use App\Models\course_programme;
use App\Models\Setting;
use Image;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\AdminRequest;
use Illuminate\Support\Facades\DB;


class AdminController extends Controller
{
    //

    
    public function __construct()
    {
        //uncomment this also before using
       // $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      
        //$this->authorize('isAdmin');
        if(\Gate::allows('isAdmin') || \Gate::allows('isAuthor')){
            return User::latest()->paginate(5);
        }
        
    }

    public function  users()
    {
         
        //$this->authorize('isAdmin');
        //please uncomment the below comment before using ...
        if(\Gate::allows('isAdmin') || \Gate::allows('isAuthor')){
            return User::latest()->paginate(5);
        }
        
    }

    public function createUser(Request $request)
    {
        //
        $this->validate($request,[
            'name'         => 'required|string|max:191',
            'email'        => 'required|string|email|max:191|unique:users',
            'password'     => 'required|string|min:6',
        ]);

        return User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => $request->type,
            'bio' => $request->bio,
            'photo' => $request->phote
        ]);
    }

    public function deleteUser($id)
    {
        $this->authorize('isAdmin');
        $user = User::findOrFail($id);
        $user->delete();
        return ['message' => 'User deleted successfully'];
    }

    public function  adminProfile()
    {
        //$this->authorize('isAdmin');
        if(\Gate::allows('isAdmin') || \Gate::allows('isAuthor')){
            return Auth::user();
        }
        
    }

   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[
            'name'         => 'required|string|max:191',
            'email'        => 'required|string|email|max:191|unique:users',
            'password'     => 'required|string|min:6',
        ]);

        return User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'type' => $request->type,
            'bio' => $request->bio,
            'photo' => $request->phote
        ]);
    }

    public function updateUser(Request $request, $id)
    {
        //
        $user = User::findOrFail($id);
       $this->validate($request,[
        'name'         => 'required|string|max:191',
        'email'        => 'required|string|email|max:191|unique:users,email,'. $user->id,
        'password'     => 'sometimes|string|min:6',
       ]);
       
       $request->merge(['password' => Hash::make($request->password)]);
        $user->update($request->all());
        return ['message' => 'User successfully updated'];
    }
      /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request)
    {
        $user = Auth::user();

        $this->validate($request,[
            'name'         => 'required|string|max:191',
            'email'        => 'required|string|email|max:191|unique:users,email,'. $user->id,
            'password'     => 'sometimes|string|min:6',
           ]);
        
        
        $currentPhoto = $user->photo;
        if($request->photo != $currentPhoto ){
            $name = time(). '.' . explode('/', explode(':', substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];
           // return $name;
           Image::make($request->photo)->save(public_path('/images/profile/'). $name);
            
          $request->merge(['photo' => $name]);
          
          $userPhoto = public_path('/images/profile/'). $currentPhoto;
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



    public function profile()
    {
        return Auth::user();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
   

   

    public function newCourse(Request $request)
    {
        $this->validate($request,[
            'course'         => 'required|string|max:191',
            'course_code'         => 'required|string|max:191',
            'unit'         => 'required|numeric',
           
           ]);
        $course_id = str_replace(' ', '', $request->course_code).date('Y');
       return Course::create([
           'course' => $request->course,
           'course_id' => $course_id ,
           'course_code' => $request->course_code,
           'unit' => $request->unit
       ]);
    }

    
    public function loadCourses()
    {
        return Course::latest()->paginate(150);
    }

    public function updateCourse(Request $request, $id)
    {
        $course = Course::findOrFail($id);
        $this->validate($request,[
            'course'         => 'required|string|max:191',
            'course_code'         => 'required|string|max:191',
            'unit'         => 'required|numeric',
           
           ]);
        $course->update($request->all());
        return ['message' => 'Course updated successfully'];
    }
    
    public function deleteCourse($id)
    {
        $this->authorize('isAdmin');
        $course = Course::findOrFail($id);
        $course->delete();
        return ['message' => 'Course deleted successfully'];
    }
    public function destroy($id)
    {
        $this->authorize('isAdmin');
        $user = User::findOrFail($id);
        $user->delete();
        return ['message' => 'User deleted successfully'];
    }

    //******************** */ FACULTY ********************
    public function faculty()
    {
        //return Faculty::all();
        return Faculty::latest()->paginate(5);
    }

    public function newFaculty(Request $request)
    {
       // dd($request->all());
        $this->validate($request,[
            'faculty'         => 'required|string|max:191',
            'faculty_code'         => 'required|string|max:191',
           ]);

       return Faculty::create([
           'faculty' => $request->faculty,
           'faculty_code' => $request->faculty_code,
       ]);
    }

    public function updateFaculty(Request $request, $id)
    {
        //dd($id);
        $faculty = Faculty::findOrFail($id);
        $this->validate($request,[
            'faculty'         => 'required|string|max:191',
            'faculty_code'         => 'required|string|max:191',
           
           ]);
        $faculty->update($request->all());
        return ['message' => 'Course updated successfully'];
    }

    public function deleteFaculty($id)
    {
        $this->authorize('isAdmin');
        $faculty = Faculty::findOrFail($id);
        $faculty->delete();
        return ['message' => 'User deleted successfully'];
    }
    //******************** */ FACULTY END ********************

     //******************** */ Department ********************

      public function department()
    {   
        //return Department::all();
        $dep_faculty = [];
        $dep = Department::latest()->paginate(5);
        $faculty =  Faculty::all();
        $dep_faculty = ['dep' => $dep, 'fac' => $faculty];
        return $dep_faculty;
    }

    public function newDepartment(Request $request)
    {
        //dd($request->faculty_id);
        $this->validate($request,[
            'department'         => 'required|string|max:191',
            'department_id'         => 'required|string|max:191',
             'faculty_id'            => 'required',
           ]);

           return Department::create([
               'department' => $request->department,
               'department_id' => $request->department_id,
               'faculty_id'     => $request->faculty_id
           ]);
    }

    public function updateDepartment(Request $request, $id)
    {
        $department = Department::findOrFail($id);
        $this->validate($request,[
            'department'         => 'required',
            'department_id'         => 'required',
            'faculty_id'         => 'required',
           
           ]);
        $department->update($request->all());
        return ['message' => 'Department updated successfully'];
    }

    public function deleteDepartment($id)
    {
        $this->authorize('isAdmin');
        $department = Department::findOrFail($id);
        $department->delete();
        return ['message' => 'Department deleted successfully'];
    }

     //******************** */ Programme  ********************
        public function programme()
        {
            
            $programmes = DB::table('programmes')
            ->join('departments', 'programmes.department_id', '=', 'departments.id')
            ->join('faculties', 'programmes.faculty_id', '=', 'faculties.id')
            ->select('programmes.id','programme','programme_id','department','faculty')
            ->get();
            $departments = DB::table('departments')->select('id', 'department')->get();
            $faculties = DB::table('faculties')->select('id','faculty')->get();
            $pro_dep_fac = ['pro' => $programmes, 'dep'=>$departments, 'fac'=>$faculties];
            return $pro_dep_fac;
        }

        public function newProgramme(Request $request)
        {
           // dd($request->all());
           $this->validate($request,[
            'programme'         => 'required',
            'programme_id'         => 'required',
            'department_id'         => 'required',
            'faculty_id'         => 'required',
           
           ]);
            return Programme::create([
                "programme" => $request->programme,
                "programme_id" => $request->programme_id,
                "department_id" => $request->department_id,
                "faculty_id" => $request->faculty_id
            ]);
        }
     //******************** */ Programme END ********************



     //******************** */Settings, Session and Semester Start ********************

     public function loadSetting()
     {  //settings
        // $settings = DB::table('settings')
        // ->select('settings.id','settings.status AS setting_status',
        // 'settings.registration_status AS setting_registration_status',
        // 'settings.started_at AS setting_started_at', 'settings.ended_at AS setting_ended_at')->get();

         $settings = DB::table('settings')
         ->select('settings.id AS setting_id','settings.status AS setting_status',
         'settings.registration_status AS setting_reg_status',
         'settings.started_at AS setting_started_at', 'settings.ended_at AS setting_ended_at',
      'sessions.session AS setting_session', 'sessions.id AS session_id','semesters.id AS semester_id',
      'semesters.semester AS setting_semester')
         ->join('sessions', 'settings.session_id' , '=','sessions.id')
         ->join('semesters','settings.semester_id', '=', 'semesters.id')
         ->get();
        //  ->orderBy('settings.id')->get();

        // sessions
         $session = DB::table('sessions')->select('id', 'session' , 'started_at AS session_started_at', 'ended_at AS session_ended_at')
         ->get();

         //semester
         $semester = DB::table('semesters')->select('id', 'semester' )->get();

         $setting_session= [ 'db_setting' => $settings, 'db_session' => $session, 'db_semester' => $semester ];

         
         return $setting_session;
     }
    //  public function session()
    //  {
    //         $session = Session::all();
    //         return $session;
    //  }

     public function newSetting(Request $request)
     {
       
            //  dd($request->all());
        
          $this->validate($request,[
            "setting_session" =>  'required',
            "setting_semester" => 'required',
            "setting_started_at" => 'required',
            "setting_ended_at" => 'required'
            
           ]);
        //check if exist in the database table
        $validate = Setting::where('session_id',$request->setting_session)
        ->where('semester_id',$request->setting_semester)->first();
        if($validate != null){
            return ["error" => "Setting Already Exist"];
        }
        else{

            $setting = new Setting;
            $setting->session_id = $request->setting_session;
            $setting->semester_id = $request->setting_semester;
            $setting->started_at = $request->setting_started_at;
            $setting->ended_at = $request->setting_ended_at;
            if($request->setting_status == 1){
                 $check = Setting::where('status',1)->first();
                if (!empty($check)) {
                    $check->status = 0;
                    $check->save();
                }
                 $setting->status = $request->setting_status;
            }
            $setting->save();
           
            return ["success" => " New setting created successfully"];
        }

              
     }

     public function newSession(Request $request)
     {
       
        
          $this->validate($request,[
            'session'         => 'required',
            'session_started_at'         => 'required',
            'session_ended_at'         => 'required'
           
           ]);
          $created = Session::create([
               'session' => $request->session,
               'started_at' => $request->session_started_at,
               'ended_at' => $request->session_ended_at
           ]);
           //"message": "SQLSTATE[23000]: 
           //Integrity constraint violation: 1062 Duplicate entry '2021/2022' for key 'sessions_session_unique'
           if($created){
               return 'Session created successfully';
           }

           return 'Error in creating new session';
           
     }

     public function updateSession(Request $request, $id)
    {
       // dd($id);

        $session = Session::findOrFail($id);
        // $this->validate($request,[
        //     'session' => $request->session,
        //     'started_at' => $request->started_at,
        //     'ended_at' => $request->ended_at
           
        //    ]);
        $session->update([           
            'session' => $request->session,
            "started_at" => $request->session_started_at,
            "ended_at" => $request->session_ended_at
        ]);
        return ['message' => 'Session updated successfully'];
    }

    
     public function updateSetting(Request $request, $id)
    {
      
         //dd($request->all());
        //dd($id);

        $setting = Setting::findOrFail($id);
        // $this->validate($request,[
        // "setting_reg_status"  => 'required',
        // "setting_status"  => 'required',
        // "setting_started_at" => 'required',
        // "setting_ended_at"  => 'required',
        //    ]);
        if($request->setting_status == 1){
            $check_status = Setting::where('status', 1)->first();
            if(!empty($check_status)){
                $check_status->status = 0;
                $check_status->save();
            }
        }

        if($request->setting_reg_status != 0){
                $settings = DB::table('settings')->pluck('id');
                foreach($settings as $id){
                    $reg_status = Setting::where('id', $id)->first();
                 $reg_status->registration_status = 0;
                 $reg_status->save();
                }
        }
       
        $setting->update([           
            'registration_status' => $request->setting_reg_status,
            "status" => $request->setting_status,
            "started_at" => $request->setting_started_at,
            "ended_at" => $request->setting_ended_at
        ]);
        return ['message' => 'Settings updated successfully'];
    }


    public function deleteSession($id)
    {
        $this->authorize('isAdmin');
        $session = Session::findOrFail($id);
        $session->delete();
        return ['message' => 'Session deleted successfully'];
    }


    public function deleteSetting($id)
    {   
       
        $this->authorize('isAdmin');
        $setting = Setting::findOrFail($id);
        if($setting->status == 1){
                return ['failed' => 'You can not delete current setting'];
        }
        else{
            $setting->delete();
            return ['message' => 'Session deleted successfully'];
        }
       
    }

   
     //******************** */ Settings, Session and Semester END ********************



     //******************** */ Curriculum start ********************
        public function curriculum()
        {
            $programmes = DB::table('programmes')->select('id', 'programme', 'programme_id')->get();
            $courses = DB::table('courses')->select('course_id AS name')->get();
            $semesters = DB::table('semesters')->select('id', 'semester')->get();
            $db_curr = DB::table('course_programme')
            ->join('courses', 'course_programme.course_id', '=', 'courses.course_id')
            ->join('programmes', 'course_programme.programme_id', '=', 'programmes.id')
            ->join('semesters', 'course_programme.semester_id', '=', 'semesters.id')
            ->select('course_programme.id', 'course_programme.status',
            'course_programme.level','courses.course','programmes.programme_id'
            ,'semesters.semester','course_programme.semester_id','courses.course_code')
            ->orderBy('programmes.programme_id')->get();
            
            $pro_cur = [ 'db_pro' => $programmes, 'db_cou' => $courses, 'db_cur' => $db_curr, 'db_seme'=>$semesters ];
            return $pro_cur;
        }

        public function newCurriculum(Request $request)
        {  $course = [];
            //dd($request->course_status);
            foreach($request->course_id as $name){
               array_push($course, $name['name'] ) ;
            }
            // dd($request->all());

            $this->validate($request,[
                'programme_id'         => 'required',
                'course_id'         => 'required',
                
                'semester'         => 'required',
                'level'         => 'required',
               
               ]);
            $programmes = Programme::findOrFail($request->programme_id);

            //dd($request->programme_id);
           
           $programmes->courses()->attach($course ,
            ['semester_id' => $request->semester, 'level' => $request->level, 
            'type_id'=>$request->semester,'status'=> 'C', 'de_id'=>$request->semester]);
            //update course status
            if(!empty($request->course_status)){
                foreach($request->course_status as $status){
                    DB::table('course_programme')
                    ->where('course_id', $status['name'])
                    ->update(['status' => 'E']);
                 }
            }
           
        }


        public function updateCurriculum(Request $request, $id)
        {
            $curriculum = course_programme::findOrFail($id);
            //dd($request->all());
            //dd($curriculum);
        $this->validate($request,[
            'semester'         => 'required',
            'status'         => 'required',
            'level'         => 'required',
           
           ]);
           if($request->semester === "First Semester"){ $request->semester = 1;}
           elseif($request->semester === "Second Semester"){ $request->semester = 2;}
           elseif($request->semester === "Third Semester"){ $request->semester = 3;}
           else{$request->semester = " ";}

           //dd($request->semester);

        $curriculum->update([
            'semester_id'   => $request->semester ,
            'status'     => $request->status ,
            'level'      => $request->level ,
        ]);
        return ['message' => 'curriculum updated successfully'];

        }

        public function deleteCurriculum($id)       
        {
            $this->authorize('isAdmin');
            $del_cur = course_programme::findOrFail($id);
            $del_cur->delete();
            return ['message' => 'Curriculum deleted successfully'];
        }

        public function searchCurriculum(Request $request)
        {
             $searchResult =  $db_curr = DB::table('course_programme')
             ->join('courses', 'course_programme.course_id', '=', 'courses.course_id')
             ->join('programmes', 'course_programme.programme_id', '=', 'programmes.id')
             ->join('semesters', 'course_programme.semester_id', '=', 'semesters.id')
             ->select('course_programme.id', 'course_programme.status',
             'course_programme.level','courses.course','programmes.programme_id'
             ,'semesters.semester','courses.course_code')
             ->orderBy('programmes.programme_id')->get();

            if($search = $request->q){
               
                $searchResult =  DB::table('course_programme')
            ->join('courses', 'course_programme.course_id', '=', 'courses.course_id')
            ->join('programmes', 'course_programme.programme_id', '=', 'programmes.id')
            ->join('semesters', 'course_programme.semester_id', '=', 'semesters.id')
            ->select('course_programme.id', 'course_programme.status',
            'course_programme.level','courses.course','programmes.programme_id'
            ,'semesters.semester','courses.course_code')
            ->where(function($query) use ($search){
                $query->where('course_programme.status', 'like', "%$search%")
                ->orWhere('course_programme.level', 'like', "%$search%")
                ->orWhere('courses.course', 'like',  "%$search%")
                ->orWhere('programmes.programme_id', 'like',  "%$search%")
                ->orWhere('semesters.semester', 'like',  "%$search%");
            })->orderBy('programmes.programme_id')->get();
            }

             return $searchResult;
        }


        public function searchCurriculum2(Request $request)
        {
            $searchResult = Null;
            $querystring = json_decode($request->q, true);

               // dd(current(array_keys($querystring)));
            
             if(count($querystring) == 1){
                 switch(current(array_keys($querystring))){
                        case "byprogramme":
                            if(!empty($querystring)){
               
                            $searchResult =  DB::table('course_programme')
                            ->join('courses', 'course_programme.course_id', '=', 'courses.course_id')
                            ->join('programmes', 'course_programme.programme_id', '=', 'programmes.id')
                            ->join('semesters', 'course_programme.semester_id', '=', 'semesters.id')
                            ->select('course_programme.id', 'course_programme.status',
                            'course_programme.level','courses.course','programmes.programme_id'
                            ,'semesters.semester','courses.course_code')
                                ->where('programmes.programme_id',  $querystring['byprogramme'])
                                 ->orderBy('programmes.programme_id')->get();          
                            
                            }
                             break;
                        case "bystatus":

                            if(!empty($querystring)){
                                $searchResult =  DB::table('course_programme')
                                ->join('courses', 'course_programme.course_id', '=', 'courses.course_id')
                                ->join('programmes', 'course_programme.programme_id', '=', 'programmes.id')
                                ->join('semesters', 'course_programme.semester_id', '=', 'semesters.id')
                                ->select('course_programme.id', 'course_programme.status',
                                'course_programme.level','courses.course','programmes.programme_id'
                                ,'semesters.semester','courses.course_code')
                                    ->where('course_programme.status',  $querystring['bystatus'])
                                     ->orderBy('programmes.programme_id')->get();          
                                
                                }
                            break;

                        case "bylevel":
                            if(!empty($querystring)){
                                $searchResult =  DB::table('course_programme')
                                ->join('courses', 'course_programme.course_id', '=', 'courses.course_id')
                                ->join('programmes', 'course_programme.programme_id', '=', 'programmes.id')
                                ->join('semesters', 'course_programme.semester_id', '=', 'semesters.id')
                                ->select('course_programme.id', 'course_programme.status',
                                'course_programme.level','courses.course','programmes.programme_id'
                                ,'semesters.semester','courses.course_code')
                                    ->where('course_programme.level',  $querystring['bylevel'])
                                     ->orderBy('programmes.programme_id')->get();          
                                
                                }
                             break;
                         
                        default:
                           echo "working";
                   
                  }
              }
              elseif(count($querystring) == 2){

                if((array_key_exists("byprogramme",$querystring)) && (array_key_exists("bystatus",$querystring)) ){
                   
                    if(!empty($querystring)){
                        $searchResult =  DB::table('course_programme')
                        ->join('courses', 'course_programme.course_id', '=', 'courses.course_id')
                        ->join('programmes', 'course_programme.programme_id', '=', 'programmes.id')
                        ->join('semesters', 'course_programme.semester_id', '=', 'semesters.id')
                        ->select('course_programme.id', 'course_programme.status',
                        'course_programme.level','courses.course','programmes.programme_id'
                        ,'semesters.semester','courses.course_code')
                            ->where('course_programme.status',  $querystring['bystatus'])
                            ->where('programmes.programme_id',  $querystring['byprogramme'])
                             ->orderBy('programmes.programme_id')->get();          
                        
                        }
                }

                elseif((array_key_exists("byprogramme",$querystring)) && (array_key_exists("bylevel",$querystring)) ){
                   
                    if(!empty($querystring)){
                        $searchResult =  DB::table('course_programme')
                        ->join('courses', 'course_programme.course_id', '=', 'courses.course_id')
                        ->join('programmes', 'course_programme.programme_id', '=', 'programmes.id')
                        ->join('semesters', 'course_programme.semester_id', '=', 'semesters.id')
                        ->select('course_programme.id', 'course_programme.status',
                        'course_programme.level','courses.course','programmes.programme_id'
                        ,'semesters.semester','courses.course_code')
                            ->where('course_programme.level',  $querystring['bylevel'])
                            ->where('programmes.programme_id',  $querystring['byprogramme'])
                             ->orderBy('programmes.programme_id')->get();          
                        
                        }

                }
                elseif((array_key_exists("bystatus",$querystring)) && (array_key_exists("bylevel",$querystring)) ){
                   
                    if(!empty($querystring)){
                        $searchResult =  DB::table('course_programme')
                        ->join('courses', 'course_programme.course_id', '=', 'courses.course_id')
                        ->join('programmes', 'course_programme.programme_id', '=', 'programmes.id')
                        ->join('semesters', 'course_programme.semester_id', '=', 'semesters.id')
                        ->select('course_programme.id', 'course_programme.status',
                        'course_programme.level','courses.course','programmes.programme_id'
                        ,'semesters.semester','courses.course_code')
                            ->where('course_programme.status',  $querystring['bystatus'])
                            ->where('course_programme.level',  $querystring['bylevel'])
                             ->orderBy('programmes.programme_id')->get();          
                        
                        }

                }
                else{
                   
                    dd("default");

                }
                
                      
              }
           
              elseif(count($querystring) == 3){

                if((array_key_exists("byprogramme",$querystring)) && 
                (array_key_exists("bystatus",$querystring)) && 
                (array_key_exists("bylevel",$querystring))){
                   
                    if(!empty($querystring)){
                        $searchResult =  DB::table('course_programme')
                        ->join('courses', 'course_programme.course_id', '=', 'courses.course_id')
                        ->join('programmes', 'course_programme.programme_id', '=', 'programmes.id')
                        ->join('semesters', 'course_programme.semester_id', '=', 'semesters.id')
                        ->select('course_programme.id', 'course_programme.status',
                        'course_programme.level','courses.course','programmes.programme_id'
                        ,'semesters.semester','courses.course_code')
                            ->where('course_programme.status',  $querystring['bystatus'])
                            ->where('programmes.programme_id',  $querystring['byprogramme'])
                            ->where('course_programme.level',  $querystring['bylevel'])
                             ->orderBy('programmes.programme_id')->get();          
                        
                        }
                }
                      
              }
    

             return $searchResult;
        }
     //******************** */ Curriculum END **********************



     //******************** */ SMS START **********************
     private function send_sms($DSTADDR, $MESSAGE, $SENDERID) {
        try {
            $ch = curl_init();
    
            $URL = "http://www.cellcore.com.ng/cgi-bin/sms/api.cgi?DST=" . $DSTADDR . "&SRC=" . urlencode($SENDERID) . "&USR=runsms&PWD=g04run&MSG='" . urlencode($MESSAGE) . "'";
            curl_setopt($ch, CURLOPT_URL, $URL);
    
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    
            curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1); // don't use a cached version of the url  seems to b done in another way below
    
            curl_setopt($ch, CURLOPT_HTTPHEADER, Array("Expires: Mon, 26 Jul 1997 05:00:00 GMT"));
            curl_setopt($ch, CURLOPT_HTTPHEADER, Array("Last-Modified: " . gmdate("D, d M Y H:i:s") . "GMT"));
            curl_setopt($ch, CURLOPT_HTTPHEADER, Array("Cache-Control: no-cache, must-revalidate"));
            curl_setopt($ch, CURLOPT_HTTPHEADER, Array("Pragma: no-cache"));
    
            $result = curl_exec($ch);
            $errNum = curl_errno($ch);
            $info = curl_getinfo($ch);
            curl_close($ch);
            if ($errNum == 0)
                return TRUE;
            return FALSE;
        } catch (Exception $e) {
            return FALSE;
        }
    }
     //******************** */ SMS END **********************


     public function sms()
     {  $user = DB::table('phone_nos')->skip(800)->take(1179)->get();
    
        //dd($user);
    
        $user_email = $user->pluck('phone1')->toArray();
        $y = "Kindly login to the Student portal and edit your main email to your Run-email for the sake of the forthcoming online exams.You'll also find the link to join the online training coming up Fri 24th July 10am.";
        $z = 'RUNICT';
        $counter = 1;
        //dd($user_email );
        foreach($user_email as $phone ){
            set_time_limit(0);      
           if($this->send_sms($phone, $y, $z)){
                       echo "Message sent successfully  " . $counter . "<br>";
                       $counter++;
                   }else{ echo "Error sendind message  ". $counter. "<br>";}
                   
                   
     
     }
     
     }


}
