<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Contracts\Cache\Factory;

class AdminSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard.edit.settings');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function show(Setting $setting)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function edit(Setting $setting)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Factory $cache, Setting $setting)
    {
        $validated = $request->validate([
            "start_datetime" => 'required',
            "end_datetime" => 'required'
        ]);
        // Setting::where('key', $request->key)->update(array('value' => $request->value));

        foreach ($validated as $key => $value) {
            // $newDateTime = new \DateTime($value);
            // $newDateTime->setTimezone(new \DateTimeZone("UTC"));
            // $utc = $newDateTime->format("Y-m-d H:i");

            // $local = strtotime(date('Y-m-d H:i', strtotime($value)));

            // $offset = date('Z');

            // $utc = date('Y-m-d H:i', $local - $offset);

            $tz_from = new \DateTimeZone('Europe/Brussels');
            $tz_to = new \DateTimeZone('UTC');

            $orig_time = new \DateTime($value, $tz_from);
            $new_time = $orig_time->setTimezone($tz_to);

            $utc = $new_time->format('Y-m-d H:i');

            Setting::where('key', $key)->update(array('value' => $utc));
        }

        cache()->forget('settings');
        // When the settings have been updated, clear the cache for the key 'settings'
        $settings = cache()->remember(
            'settings',
            3600,
            fn () => Setting::all()->keyBy('key')
        );
        view()->share('settings', $settings);
        return redirect()->route('dashboard.settings.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\Response
     */
    public function destroy(Setting $setting)
    {
        //
    }
}
