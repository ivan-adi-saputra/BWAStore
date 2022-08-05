<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Province;
use App\Models\Regency;
use App\Models\User;
use Illuminate\Http\Request;

use function GuzzleHttp\Promise\all;

class DashboardSettingController extends Controller
{
    public function setting()
    {
        $user = auth()->user();
        $categories = Category::all();
        return view('pages.dashboard-setting', [
            'user' => $user, 
            'categories' => $categories
        ]);
    }

    public function storeSetting(Request $request, $redirect)
    {
        $data = $request->except(['_method', '_token']);
        User::where('id', auth()->user()->id)
            ->update($data);

        return redirect()->route($redirect);
    }

    public function account()
    {
        return view('pages.dashboard-account', [
            'user' => auth()->user(), 
        ]);
    }

    public function storeAccount(Request $request)
    {
        $data = $request->except(['_token', '_method']);
        User::where('id', auth()->user()->id)
                    ->update($data);

        return redirect()->back();
    }
}
