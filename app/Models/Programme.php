<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Programme extends Model
{

        public $guarded = [];



    public function courses()
    {
      return $this->belongsToMany('App\Models\Course','course_programme', 'programme_id', 'course_id')
      ->as('cp')
      ->withTimestamps()
      ->withPivot( 'semester_id','level','status', 'type_id', 'de_id', 'de_course');
    }

}
