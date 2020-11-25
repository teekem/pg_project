<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Auth;
use Illuminate\Support\Facades\DB;
class CourseRegistrationRule implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */

    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
            $user_id = Auth::user()->id;
            $db = DB::table('course_student')
            ->select('student_id', 'course_id')
            ->where('student_id', $user_id)
            ->where('course_id', $value)
            ->first();

            if ($db) {
                return false;
            }

            else { return true; }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        // return 'The validation error message.';
        return ':attribute' . ' ' . __('Like you have registered before in this semester and session');
    }
}
