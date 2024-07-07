<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class SettingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $settings = Setting::pluck('value', 'key')->toArray();
        if(!$settings){
            $settings = config('settings.default');
        }

        return $settings;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $settings = request()->validate([
            'app_name' => 'required|string',
            'date_format' => 'required|string',
            'pagination_limit' => 'required|integer|min:1|max:100'
        ]);

        foreach ($settings as $key => $setting) {
            Setting::updateOrCreate([
                'key' => $key
            ],[
                'value' => $setting
            ]);
        }
        Cache::flush();
        return response()->json(['success' => 'Settings updated scuccessfully']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
