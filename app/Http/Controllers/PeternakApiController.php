<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class PeternakApiController extends Controller
{
    public function users(User $user)
    {
    	$users = $user->all();

    	return response()->json($users);
    }
}
