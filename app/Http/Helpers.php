<?php

use App\Models\User;

if (! function_exists('isUnique')) {
    /**
     * Generate an asset path for the application.
     *
     * @param  string  $path
     * @param  bool|null  $secure
     * @return string
     */
    function isUnique($email)
    {
        $user = User::where('emailAdd', $email)->first();

        if($user == null) {
            return '1'; // $user = null means we did not get any match with the email provided by the user inside the database
        } else {
            return '0';
        }
    }
}

//highlights the selected navigation on side panel
if (! function_exists('areActiveRoutes')) {
    function areActiveRoutes(Array $routes, $output = "active-link")
    {
        foreach ($routes as $route) {
            if (Route::currentRouteName() == $route) return $output;
        }

    }
}
if (!function_exists('unique_code')) {
    function unique_code () {
        $number = now()->format('Ymd').DB::table('users')->max('id') + 1;

        if (unique_code_exists($number)) {
            return unique_code();
        }

        return $number;
    }
}
if (!function_exists('unique_code_exists')) {
    function unique_code_exists ($number) {
        return User::where('unique_id', $number)->exists();
    }
}
