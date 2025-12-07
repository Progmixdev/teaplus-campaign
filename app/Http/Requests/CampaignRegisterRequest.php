<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Http\Rules\NoPathTraversal;
use Illuminate\Support\Facades\Http;
use Closure;

class CampaignRegisterRequest extends FormRequest
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
        $rules = [
            '_token'  => [new NoPathTraversal],
            'campaign_number'    => ['required', 'exists:campaigns,campaign_number', 'max:191', new NoPathTraversal],
            'phone'   => [
                'required',
                'regex:/^0?5[0-9]\d{7}$/',
                'min:9',
                'max:9',
                new NoPathTraversal
            ],
            'phone_code'   => [
                'required',
                'regex:/^\+?(972|970)$/',
                new NoPathTraversal
            ],
        ];

        if (config('services.captcha.site_key')) {
            $rules['g-recaptcha-response'] = [
                'required',
                function (string $attribute, mixed $value, Closure $fail) {
                    $g_response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
                        'secret'   => config('services.captcha.secret'),
                        'response' => $value,
                        'remoteip' => request()->ip(),
                    ]);
                    if (! $g_response->json()['success']) {
                        $fail('Captcha is not valid');
                    }
                },
            ];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'campaign_number.required'  => 'رقم الحملة مطلوب',
            'campaign_number.max'       => 'رقم الحملة يجب أن يكون أقصر من 191 حرف',
            'campaign_number.string'    => 'رقم الحملة يجب أن يكون عبارة عن نص',
            'campaign_number.exists'    => 'رقم الحملة خاطئ',
            'phone.required' => 'رقم الهاتف مطلوب',
            'phone.regex'    => 'رقم الهاتف غير صالح',
            'phone.min'      => 'رقم الهاتف يجب أن يكون أطول من 8 أرقام',
            'phone.max'      => 'رقم الهاتف يجب أن يكون أقصر من 20 أرقام',
            'g-recaptcha-response.required' => 'التحقق مطلوب',
            'g-recaptcha-response.captcha'  => 'التحقق غير صالح',
        ];
    }
}
