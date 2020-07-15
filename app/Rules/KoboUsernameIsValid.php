<?php

namespace App\Rules;

use Illuminate\Support\Facades\Http;
use Illuminate\Contracts\Validation\Rule;

class KoboUsernameIsValid implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if($value===null) return true;

        $testForm = config('services.kobo.test_form');
        $endPoint = config('services.kobo.endpoint_v2');

        $payload = [
            'permission' => $endPoint . '/permissions/add_submissions/',
            'user' => $endPoint . '/users/' . $value . '/',
        ];

        $response = Http::withBasicAuth(config('services.kobo.username'), config('services.kobo.password'))
        ->withHeaders(['Accept' => 'application/json'])
        ->post($endPoint . '/assets/' . $testForm . '/permission-assignments/', $payload);

        if($response->failed()) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return t('That username cannot be found on kf.kobotoolbox.org. Please use an active username.');
    }
}
