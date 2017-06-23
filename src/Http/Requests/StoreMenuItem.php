<?php

namespace Belt\Menu\Http\Requests;

use Belt\Core\Http\Requests\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class StoreSection
 * @package Belt\Content\Http\Requests
 */
class StoreMenuItem extends FormRequest
{

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'label' => 'required',
            'url' => 'required',
        ];
    }

}