<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TestApiController extends Controller
{
    public function index()
    {
        return response()->json(['Data' => 'Testing API']);
    }
}
