<?php
use Illuminate\Http\Request;

Route::get('/', function () {
    return view('welcome');
})->name('index');

Route::get('/sql', 'SqlStatement@uniq');



Route::get('/studentLogin', 'Auth\StudentLoginController@showStudentLoginForm')->name('student.login');
Route::post('/studentLogin', 'Auth\StudentLoginController@login');
Route::post('/studentLogout', 'Auth\StudentLoginController@logout')->name('student.logout');
Route::get('/student', 'Student\StudentController@index')->name('student.dashboard');
Route::get('/stuprofile', 'Student\StudentController@sProfile')->name('student.profile');
Route::put('/updateprofile', 'Student\StudentController@updateProfile')->name('update.profile');
Route::get('/loadcoursereg', 'Student\StudentController@available_courses_for_registration_for_this_semester')->name('course.reg');
Route::post('/registercourse', 'Student\StudentController@registerCourse')->name('course.registration');
Route::post('/updateregistration', 'Student\StudentController@updateCourseRegistration')->name('update.registration');
// Route::get('/{any}', 'Student\StudentController@index')->where('any', '.*');

// Route::get('/student', 'Student\StudentController@index')->name('stu.dashboard');
// Route::get('/studLogin', 'Student\StudentLoginController@showLoginForm')->name('stu.login.form');
// Route::post('/studLogin', 'Student\StudentRegisterController@login')->name('stu.login.submit');

Auth::routes();

Route::get('/admin', 'HomeController@index')->name('admin');

//Route::get('/admin', 'Student\StudentController@index')->name('admin');
//Route::get('/admin', 'Student\StudentController@index')->name('admin');

Route::get('/sms', 'Admin\AdminController@sms')->name('sms'); 
Route::get('/adminusers', 'Admin\AdminController@users')->name('admin.users'); 
Route::post('/createUser', 'Admin\AdminController@createUser')->name('create.user'); 
Route::put('/updateuser/{id}', 'Admin\AdminController@updateUser')->name('update.user'); 
Route::delete('/deleteUser/{id}', 'Admin\AdminController@deleteUser')->name('delete.user'); 

Route::get('/adminprofile', 'Admin\AdminController@adminProfile')->name('admin.profile'); 

Route::post('/newCourse', 'Admin\AdminController@newCourse')->name('new.course');
Route::get('/loadCourses', 'Admin\AdminController@loadCourses')->name(' load.courses');
Route::put('/updatecourse/{id}', 'Admin\AdminController@updateCourse')->name(' update.course');
Route::delete('/deletecourse/{id}', 'Admin\AdminController@deleteCourse')->name(' delete.course');
//************* Faculty *****************************************************/
Route::get('/loadfaculty', 'Admin\AdminController@faculty')->name('faculty'); 
Route::post('/postnewfaculty', 'Admin\AdminController@newFaculty')->name('new.faculty');
Route::put('/updatefaculty/{id}', 'Admin\AdminController@updateFaculty')->name('update.faculty'); 
Route::delete('/deletefaculty/{id}', 'Admin\AdminController@deleteFaculty')->name('delete.faculty');
//************* Faculty end ************************************************************************/

//******************** */ Department ****************************************************************
Route::get('/loaddepartment', 'Admin\AdminController@department')->name('load.department'); 
Route::post('/ postnewdepartment', 'Admin\AdminController@newDepartment')->name('new.department');
Route::put('/updatedepartment/{id}', 'Admin\AdminController@updateDepartment')->name('update.department');
Route::delete('/deletedepartment/{id}', 'Admin\AdminController@deleteDepartment')->name('delete.department');

     

//******************** */ Department END ***********************************************************


//******************** */ Programme  ****************************************************************
Route::get('/loadprogramme', 'Admin\AdminController@programme')->name('programme');
Route::post('/postnewprogramme', 'Admin\AdminController@newProgramme')->name('new.programme');
 //******************** */ Programme END ************************************************************

//******************** */ Session  ****************************************************************
Route::get('/loadsetting', 'Admin\AdminController@loadSetting')->name('setting');
Route::post('/postnewsetting', 'Admin\AdminController@newSetting')->name('new.setting');
Route::put('/updatesetting/{id}', 'Admin\AdminController@updateSetting')->name('update.setting');
Route::delete('/deletesetting/{id}', 'Admin\AdminController@deleteSetting')->name('delete.setting');

Route::post('/postnewsession', 'Admin\AdminController@newSession')->name('new.session');
Route::put('/updatesession/{id}', 'Admin\AdminController@updateSession')->name('update.session');
Route::delete('/deletesession/{id}', 'Admin\AdminController@deleteSession')->name('delete.session');

Route::get('/loadsetting', 'Admin\AdminController@loadSetting')->name('setting');
 //******************** */ Session END ************************************************************


//********************************************************** */ Curriculum start ********************


Route::get('/loadcurriculum', 'Admin\AdminController@curriculum')->name('curriculum');
Route::post('/postnewcurriculum', 'Admin\AdminController@newCurriculum')->name('new.curriculum');
Route::put('/updatecurriculum/{id}', 'Admin\AdminController@updateCurriculum')->name('update.curriculum');
Route::delete('/deletecurriculum/{id}', 'Admin\AdminController@deleteCurriculum')->name('delete.curriculum');
Route::get('/searchcurriculum', 'Admin\AdminController@searchCurriculum')->name('search.curriculum');
Route::get('/searchcurriculum2', 'Admin\AdminController@searchCurriculum2')->name('search2.curriculum');



//********************************************************** */ Curriculum END **********************


Route::get('/{vue_capture?}', function (Request $request) {

    echo $request->path();
    // if(Auth::guard('student')->check()) {return redirect()->route('student.dashboard');}

    // if (Auth::guard('web')->check()) { return redirect()->route('home');}

})->where('vue_capture', '[\/\w\.-]*');