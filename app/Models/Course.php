<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public $guarded = [];


    public function programmes()
    {
      return $this->belongsToMany('App\Models\Programme','course_programme', 'programme_id', 'course_id')
      ->as('cp')
      ->withTimestamps()
      ->withPivot( 'semester_id','level','status', 'type_id', 'type', 'de_id', 'de_course');
    }

    public function students()
    {
      return $this->belongsToMany('App\Models\Student','course_student','student_id', 'course_id')
      ->as('cs')
      ->withTimestamps()
      ->withPivot( 'matric_no','setting_id', 'unit','reg_level', 'course_status', 'reg_status');
    }

















}
