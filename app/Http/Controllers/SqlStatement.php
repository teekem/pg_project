<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class SqlStatement extends Controller
{
    
    
    public function sql()
    {
      DB::statement('TRUNCATE TABLE setting_student');
      

      // DB::statement("ALTER TABLE 'setting_student'
      //          ADD UNIQUE 'unique_index'('student_id', 'setting_id', 'course_id')");
    }
    
    public function uniq()
    {
    //    this one is correct
       // ALTER TABLE `setting_student` ADD UNIQUE( `matric_no`,`student_id`,`setting_id`,`course_id`)


        DB::statement('');

      
    }

}
