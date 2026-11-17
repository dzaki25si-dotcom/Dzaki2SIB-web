<?php


namespace App\Http\Controllers;


use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


class DashboardController extends Controller
{




    public function index(){
        if (!Auth::check()) {
            return redirect()->route('login')
                ->withErrors(['email' => 'Silakan login terlebih dahulu'])
                ->onlyInput('email');
        }


        return view("admin.dashboard.index");
    }
}
