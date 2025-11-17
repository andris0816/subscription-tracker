<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class StoreSubscriptionRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'renewal_date' => 'required|date',
            'currency' => 'required',
            'billing_cycle' => 'required|string',
            'cancel_url' => 'nullable|string|url',
        ];
    }

    protected function prepareForValidation()
    {
        if ($this->renewal_date) {
            $this->merge([
                'renewal_date' => Carbon::parse($this->renewal_date)->format('Y-m-d')
            ]);
        }
    }
}
