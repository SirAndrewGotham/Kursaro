<?php

namespace App\Http\Requests;

use App\Models\Home;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyHomeRequest extends FormRequest
{
    public function authorize()
    {
//        abort_if(Gate::denies('home_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');
//
//        return true;
        return Auth::check();
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:homes,id',
        ];
    }
}
