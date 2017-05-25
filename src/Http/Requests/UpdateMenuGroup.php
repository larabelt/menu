<?php
namespace Belt\Menu\Http\Requests;

use Belt\Core\Http\Requests\FormRequest;

/**
 * Class UpdateBlock
 * @package Belt\Content\Http\Requests
 */
class UpdateMenuGroup extends FormRequest
{

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'sometimes|required',
        ];
    }

}