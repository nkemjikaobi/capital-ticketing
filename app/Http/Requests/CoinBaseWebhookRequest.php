<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Log;

class CoinBaseWebhookRequest extends FormRequest
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
            //
        ];
    }

    protected function hasValidSignature(): bool
    {
        Log::info("About to handle");
           return $this->hasHeader('X-CC-Webhook-Signature') && $this->signatureMatches();
    }

    protected function signatureMatches(): bool
    {
        Log::info("Coinbase webhook signature -".$this->server->get('HTTP_X-CC-WEBHOOK-SIGNATURE'));
        return $this->server->get('HTTP_X-CC-WEBHOOK-SIGNATURE')
            ===
            hash_hmac(
                'sha256',
                json_encode($this->all()),
                '92596e13-5162-4505-a05c-ad94c3c26c39'
            );
    }
}
