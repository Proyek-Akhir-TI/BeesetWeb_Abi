<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ErrorFormRequest extends FormRequest
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
            'nama' => 'unique:users',
            'email'  => 'unique:users',
            'password' => 'min:6|confirmed',
            'photo' => 'max:500',
        ];
    }

    public function messages(){
        return [
            'nama.unique' => 'Nama sudah dipakai, daftarkan dengan nama lain',
            'email.unique' => 'Email sudah dipakai, daftarkan dengan email lain',
            'password.min' => 'Password minimal 6 karakter',
            'photo.max' => 'Gambar terlalu besar, maximal 500kb',
        ]; 
    }
}
