<?php
namespace Belt\Menu\Http\Requests;

use Belt\Core\Http\Requests\FormRequest;

/**
 * Class StoreBlock
 * @package Belt\Content\Http\Requests
 */
class StoreMenuGroup extends FormRequest
{

    /**
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|unique:blocks,name',
        ];
    }

}