<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Carrier;
use App\Models\Finance;
use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $count = [
            'user' => User::count(),
            'warehouse' => Warehouse::count(),
            'carrier' => Carrier::count(),
            'finance' => Finance::count()
        ];
        
        return view('admin.pages.dashboard',[
            'title' => 'Dashboard',
            'count' => $count
        ]);
    }
}
