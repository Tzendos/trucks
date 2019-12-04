<?php
/**
 * File: TruckImgRequest.php
 * Author: Vladimir Pogarsky <hacking.memory@gmail.com>
 * Date: 2019-12-04
 * Copyright (c) 2019
 */

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

/**
 * Class TruckImgRequest
 * @package App\Http\Requests\Api
 */
class TruckImgRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'picture' => [
                'required',
                'image',
                'mimes:jpeg,png,jpg',
                'max:51200',
            ],
        ];
    }
}
