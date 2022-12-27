<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\GlobalSetting;
use Illuminate\Support\Facades\File;

/**
 * Class GlobalSettingController
 * @package App\Http\Controllers\Admin
 */
class GlobalSettingController extends Controller
{

    public function global_setting()
    {
        $global_setting = GlobalSetting::find(1);
        return view('admin.global_setting', compact('global_setting'));
    }

    public function updateSettings(Request $request)
    {
        $request->offsetUnset('_token'); // Confirmed _token field is gone.
        $data = $request->all();
        $setting = GlobalSetting::find(1);

        if ($request->hasFile('favicon')) {
            if (!empty($setting->favicon)) {
                if (file_exists(public_path('uploads/icons') . '/' . $setting->favicon)) {
                    File::delete('uploads/icons/' . $setting->favicon);
                }
            } else {
                File::makeDirectory(public_path('uploads/icons'), 0777, true, true);
            }
            $favicon = $request->file('favicon');
            $data['favicon'] = time() . '_' . $favicon->getClientOriginalName();
            $destinationPath = public_path('uploads/icons');
            $favicon->move($destinationPath, $data['favicon']);
        }

        if ($request->hasFile('site_logo')) {
            if (!empty($setting->site_logo)) {
                if (file_exists(public_path('uploads/icons') . '/' . $setting->site_logo)) {
                    File::delete('uploads/icons/' . $setting->site_logo);
                }
            } else {
                File::makeDirectory(public_path('uploads/icons'), 0777, true, true);
            }
            $favicon = $request->file('site_logo');
            $data['site_logo'] = time() . '_' . $favicon->getClientOriginalName();
            $destinationPath = public_path('uploads/icons');
            $favicon->move($destinationPath, $data['site_logo']);
        }

        GlobalSetting::where('id', 1)->update($data);
        return redirect()->back()->with('success', 'Settings update has been successful!');
    }

}
