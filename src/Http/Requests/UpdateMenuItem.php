<?php
namespace Belt\Menu\Http\Requests;

use Belt\Core\Http\Requests\FormRequest;

/**
 * Class UpdateSection
 * @package Belt\Content\Http\Requests
 */
class UpdateMenuItem extends FormRequest
{

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'label' => 'sometimes|required',
            'url' => 'sometimes|required',
        ];
    }

}