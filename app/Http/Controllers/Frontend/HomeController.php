<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Book;

class HomeController
{
    public function __invoke()
    {
        return view('frontend.default.home.index');
    }
}
