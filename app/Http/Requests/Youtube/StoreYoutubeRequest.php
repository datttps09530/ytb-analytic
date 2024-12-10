<?php

namespace App\Http\Requests\Youtube;

use App\Http\Requests\CoreRequest;

class StoreYoutubeRequest extends CoreRequest
{

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'url' => 'required',
            'email_host_main' => 'required',
            'status' => 'required',
        ];
    }

}
