<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoomBookingRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'room_id' => ['required', 'exists:App\Models\Room,id'],
            'start' => ['required', 'date'],
            'end' => ['required', 'date'],
            'reason' => ['required', 'max:255']
        ];
    }
}
