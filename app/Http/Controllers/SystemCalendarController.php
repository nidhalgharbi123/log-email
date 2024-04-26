<?php

namespace App\Http\Controllers;
use App\Models\Intervention;
use Illuminate\Http\Request;
use Carbon\Carbon;

class SystemCalendarController extends Controller
{
  

    public function index()
    {
      

        return view('calendar.calendar');
    }
}
