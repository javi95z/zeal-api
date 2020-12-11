<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class BaseController extends Controller
{
    public $ruleNames;

    public function __construct()
    {
        $this->middleware('jwt');
    }

    public function validation(Request $request)
    {
        $validator = Validator::make($request->all(), config($this->ruleNames));
        if ($validator->fails()) {
            return $validator->errors();
        } else {
            return true;
        }
    }
}
