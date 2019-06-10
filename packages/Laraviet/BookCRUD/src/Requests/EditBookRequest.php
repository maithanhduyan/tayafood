<?php
namespace Laraviet\BookCRUD\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditBookRequest extends FormRequest
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
            "title" => "required",
            "author" => "required",
        ];
    }

    /**
     * customize msg error
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'Title is require',
            'author.required' => 'Author is require'
        ];
    }
}
