<?php

namespace App\Http\Requests\Snapshot;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class UploadSnapshotRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return (Auth::check()) ? true : false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'file' => 'required|mimes:jpeg,png,bmp,gif,svg,mp4|max:10240'
        ];
    }
}
