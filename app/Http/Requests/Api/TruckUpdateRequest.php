<?php
/**
 * File: TruckUpdateRequest.php
 * Author: Vladimir Pogarsky <hacking.memory@gmail.com>
 * Date: 2019-12-04
 * Copyright (c) 2019
 */

declare(strict_types=1);

namespace App\Http\Requests\Api;

use App\Models\Truck;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class TruckUpdateRequest
 * @package App\Http\Requests\Api
 *
 * @property-read $name
 * @property-read $price
 */
class TruckUpdateRequest extends FormRequest
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
        $truck = $this->route('truck');

        return [
            'name' => [
                'required',
                'string',
                'max:255',
                Rule::unique('trucks', 'name')->ignore($truck->id),
            ],
            'price' => [
                'required',
                'numeric',
                'regex:/^\d+(\.\d{1,2})?$/',
            ],
        ];
    }
}
