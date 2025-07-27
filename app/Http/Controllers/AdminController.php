<?php

namespace App\Http\Controllers;

use App\Models\Grades;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Mail;
use App\Imports\ImportGrades;

class AdminController extends Controller
{
    public function uploadUsers(Request $request) {
        Excel::import(new ImportGrades, $request->file);

        return redirect()->route('users.index')->with('success', 'User Imported Successfully');
    }
}
