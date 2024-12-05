<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Home;
use App\Models\Language;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Gate;

class HomeController
{
    public function __invoke()
    {
        $lang = Language::where('code', app()->getLocale())->first()->id;
        $model = Home::where([['is_active', true],['language_id', $lang]])->first() ?? Home::where('is_default', true)->first();

        $model->timestamps = false;
        $model->views++;
        $model->save();

        $content = $model->content;

        return view('frontend.default.home.index', compact('content'));
    }
}
