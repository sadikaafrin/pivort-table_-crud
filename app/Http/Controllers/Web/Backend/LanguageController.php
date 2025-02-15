<?php

namespace App\Http\Controllers\Web\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class LanguageController extends Controller
{
    public function change(Request $request, $lan)
    {
        $lang = $request->lang;

        if (!in_array($lang, ['en', 'bn'])) {
            abort(400);
        }

        Session::put('locale', $lang);
        App::setLocale($lan);
        return redirect()->back();
    }
}
