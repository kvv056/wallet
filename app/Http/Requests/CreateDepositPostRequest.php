<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Models\Wallet;
use Illuminate\Validation\Factory as ValidationFactory;
use App\Rules\WalletAmmount;

/**
 * Description of NewDepositRequest
 * php artisan schedule:work
 * @author kvv
 */
class CreateDepositPostRequest extends FormRequest
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
            'amount' => ['required', 'integer', 'between:10,100', new WalletAmmount()]
        ];
    }
	
	
}
