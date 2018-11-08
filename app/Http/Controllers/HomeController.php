<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Entity\Adverts\Category;
use App\Entity\Region;

class HomeController extends Controller
{

    public function index(Request $request)
    {
        $regions = Region::roots()->orderBy('name')->getModels();

        return view('home', compact('regions'));
    }
}
