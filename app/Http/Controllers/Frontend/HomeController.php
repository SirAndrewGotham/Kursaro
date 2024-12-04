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
//        $user = auth()->user();
//
//        $roles            = Role::with('permissions')->get();
//        $permissionsArray = [];
//
//        foreach ($roles as $role) {
//            foreach ($role->permissions as $permissions) {
//                $permissionsArray[$permissions->title][] = $role->id;
//            }
//        }
//
//        foreach ($permissionsArray as $title => $roles) {
//            Gate::define($title, fn(User $user) => $user->is_admin);
////            Gate::define($title, function ($user) use ($roles) {
////                return count(array_intersect($user->roles->pluck('id')->toArray(), $roles)) > 0;
////            });
//        }

        $lang = Language::where('code', app()->getLocale())->first()->id;
        $model = Home::where([['is_active', true],['language_id', $lang]])->first() ?? Home::where('is_default', true)->first();
        $content = $model->content;

        return view('frontend.default.home.index', compact('content'));
    }
}
