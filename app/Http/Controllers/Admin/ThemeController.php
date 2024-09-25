<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ThemeController extends Controller
{
    public function index()
    {
        $themes = [];
        $themeDirectories = File::directories(resource_path('views/themes'));

        foreach ($themeDirectories as $themedir) {
            $themeName = basename($themedir);
            $jsonFile = $themedir . '/' . $themeName . '.json';

            if (File::exists($jsonFile)) {
                $themeData = json_decode(File::get($jsonFile), true);
                $themeData['directory'] = $themeName;

                // Set the thumbnail URL
                if (isset($themeData['thumbnail'])) {
                    $themeData['thumbnail_url'] = asset('themes/' . $themeName . '/' . $themeData['thumbnail']);
                } else {
                    $themeData['thumbnail_url'] = asset('images/default-thumbnail.png');
                }

                $themes[] = $themeData;
            }
        }

        return view('dashboard.pages.theme.theme')->with(['themes' => $themes]);
    }
}
