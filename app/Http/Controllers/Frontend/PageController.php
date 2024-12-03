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
        $parent = Page::where([['slug', $slug],['page_id', null]])->first();
        if($parent == null)
        {
            return redirect()->route('home')->with('error', trans('Requested page does not exist.'));
        }
        $page = Page::where([['is_active', true],['page_id', $parent->id],['language_id', $language_id]])->first();

        if(!$page)
        {
            $page = Page::where([['page_id', $parent->id],['is_default', true]])->first();
        }

        return view('frontend.default.home.index', ['content' => $page->content]);
    }
}
