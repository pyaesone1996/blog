<?php

namespace App\Http\Controllers;

use App\Settings;

class SettingsController extends Controller
{
    public function index()
    {
        abort_unless(current_user()->roles->pluck('name')->contains('Admin'), 404);
        return view('settings.index', ['settings' => Settings::all()]);
    }

    public function update(Settings $settings)
    {
        if (request()->site_logo) {
            $logo = request()->file('site_logo');
            $logoname = time() . str_replace(' ', '_', $logo->getClientOriginalName());
            $logo->storeAs('public/', $logoname);
        } else {
            $logoname = $settings->site_logo;
        }

        if (request()->site_icon) {
            $icon = request()->file('site_icon');
            $iconname = time() . str_replace(' ', '-', $icon->getClientOriginalName());
            $icon->storeAs('public/', $iconname);
        } else {
            $iconname = $settings->site_icon;
        }

        $settings->update([
            'site_logo' => $logoname,
            'site_icon' => $iconname,
            'site_title' => request('site_title'),
            'site_tagline' => request('site_tagline'),
            'site_description' => request('site_description'),
            'footer_information' => request('footer_information'),
            'email' => request('email'),
            'facebook' => request('facebook'),
            'twitter' => request('twitter'),
            'youtube' => request('youtube'),
        ]);

        return redirect()->back();
    }
}
