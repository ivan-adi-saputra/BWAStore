<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Transaction;

class DashboardAdminController extends Controller
{
    public function index()
    {
        return view('pages.admin.dashboard', [
            'customer' => User::count(),
            'revenue' => Transaction::sum('total_price'), 
            'transaction' => Transaction::count()
        ]);
    }
}
