<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class StatusController extends Controller
{
    public function id()
    {
        return view('admin.status.id');
    }
    public function name()
    {
        return view('admin.status.name');
    }
    public function hp()
    {
        return view('admin.status.hp');
    }
    public function atk()
    {
        return view('admin.status.atk');
    }
    public function def()
    {
        return view('admin.status.def');
    }
}
