<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests;
use App\Item;
use App\RentListItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth::user();
        $rent = new RentListItem;
        $rentList = $rent->getRentOrderDesc($user->id);
        $items = Item::all();
        return view('home', compact('user','items','rentList'));
    }
}
