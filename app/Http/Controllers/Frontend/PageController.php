<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Page;

class PageController extends Controller
{
    public function __invoke(string $slug)
    {
        $language_id = Language::where('code', app()->getLocale())->first()->id;
        $default = Page::where([['slug', $slug],['page_id', null]])->first();
        if($default == null)
        {
            return redirect()->route('home')->with('error', trans('Requested page does not exist.'));
        }
        $page = Page::where([['is_active', true],['page_id', $default->id],['language_id', $language_id]])->first();

        if($page == null)
        {
            $page = $default;
        }

        return view('frontend.default.home.index', ['content' => $page->content]);
    }
}
