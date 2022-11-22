<?php

namespace App\Api\Controllers;

use App\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        return response(status: 200);
    }
}
