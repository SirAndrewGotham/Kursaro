<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;

class LanguageController extends Controller
{
    public function __invoke($locale)
    {
        // Set current locale to the one requested
        app()->setLocale($locale);

        // Store language into the session
        session()->put('locale', $locale);

        return redirect()->back();
    }
}
