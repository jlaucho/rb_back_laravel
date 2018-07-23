<?php

namespace App\Http\Controllers\async;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class validatorsController extends Controller
{
    public function emailTaken ($email) {
    	return User::emailTaken($email);
    }
}
