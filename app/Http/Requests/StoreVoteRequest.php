<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreVoteRequest extends FormRequest
{
    public function authorize(): bool
    {
        $debug = config('app.debug');
        if ($debug) {
            return true;
        }

        return $this->user()->isVoter();
    }

    public function rules(): array
    {
        $election = $this->attributes->get('election');

        return [
            'candidate_id' => [
                'required',
                'exists:candidates,id',
                Rule::in(
                    $election->candidates()->where('active', true)->pluck('id')
                ),
            ],
        ];
    }
}
