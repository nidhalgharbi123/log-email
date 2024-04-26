<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateInterventionRequest extends FormRequest
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
            'client' => 'required|string|max:255',
            'date' => 'required|date',
            'personne' => 'required|string|max:255',
            'start_time' => 'required|date_format:Y-m-d H:i:s', // Exemple de format, à adapter à votre besoin
            'end_time' => 'required|date_format:Y-m-d H:i:s', // Exemple de format, à adapter à votre besoin
            'recurrence' => 'required|string|max:255', // Adapté en fonction du type de donnée attendu
        ];
    }
}
