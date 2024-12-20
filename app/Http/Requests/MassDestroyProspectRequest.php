<?php

namespace App\Http\Requests;

use App\Models\Prospect;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Http\FormRequest;
use Symfony\Component\HttpFoundation\Response;

class MassDestroyProspectRequest extends FormRequest
{
    public function authorize()
    {
        abort_if(Gate::denies('prospect_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return true;
    }

    public function rules()
    {
        return [
            'ids'   => 'required|array',
            'ids.*' => 'exists:prospects,id',
        ];
    }
}
