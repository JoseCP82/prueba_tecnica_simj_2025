<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     * Rules change depending on if it's store (POST) or update (PUT/PATCH).
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $userId = $this->route('user')?->id; // null if creating

        $rules = [
            'name'     => 'required|string|max:255',
            'email'    => ['required', 'email', 'max:255', 'unique:users,email'],
            'is_admin' => 'sometimes|boolean',
        ];

        if ($this->isMethod('post')) {
            // Create user rules
            $rules['password'] = 'required|string|min:6|confirmed';
        } elseif ($this->isMethod('put') || $this->isMethod('patch')) {
            // Update user rules - ignore unique email on this user's own record
            $rules['email'] = ['required', 'email', 'max:255', 'unique:users,email,' . $userId];
            // Password optional on update, so not required here
        }

        return $rules;
    }
}
