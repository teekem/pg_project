<?php

namespace App\Listeners;

use App\Events\LoginLogoutActivityEvent;
use Illuminate\Support\Facades\DB;
use App\Models\Student;
use App\Models\loginlogoutactivity;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LoginActivities
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  LoginLogoutActivityEvent  $event
     * @return void
     */
    public function handle(LoginLogoutActivityEvent $event)
    {
        $student = Student::findOrFail($event->student_id);
        dd($student);
        $log = new loginlogoutactivity();
        $log->user_id = $student->matric_no;
        $log->date = '2020';
        $log->time = '12:22';
        $log->activity = 'login';
        $log->save();
        //dd($event->user);
    }
}
