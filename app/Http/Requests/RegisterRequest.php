<?php

namespace App\Http\Requests;

use App\Dtos\RegisterData;
use App\Http\Requests\Contracts\DTOContract;
use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest implements DTOContract
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'username' => [
                'required',
                'string',
                'max:255',
            ],
            'phonenumber' => [
                'required',
                'string',
                'max:255',
            ],
        ];
    }

    public function getDto(): RegisterData
    {
        return RegisterData::from($this->validated());
    }
}
