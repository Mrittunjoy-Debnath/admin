<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\VisiotrModel;

class VisitorController extends Controller
{
    function VisitorIndex(){


        $VisitorData = json_decode(VisiotrModel::orderBy('id','desc')->take(3)->get());

        return view('Visitor',['VisitorData'=>$VisitorData]);
    }
}
