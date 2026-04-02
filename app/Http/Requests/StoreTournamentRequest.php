<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTournamentRequest extends FormRequest
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
            'name'         => 'required|string|max:255',
            'game_id'      => 'required|exists:games,id',
            'max_players'  => 'required|integer|min:2',
            'start_date'   => 'required|date|after:now',
            'format'       => 'required|in:single_elimination,league',
            'description'  => 'nullable|string',
        ];
    }
}
