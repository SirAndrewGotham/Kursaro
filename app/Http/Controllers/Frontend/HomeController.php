<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Home;
use App\Models\Language;

class HomeController
{
    public function __invoke()
    {
        $lang = Language::where('code', app()->getLocale())->first()->id;
        $model = Home::where([['is_active', true],['language_id', $lang]])->first() ?? Home::where('home_id', null)->first();
        $content = $model->content;

        return view('frontend.default.home.index', compact('content'));
    }
}
