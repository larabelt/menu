import BaseForm from 'belt/core/js/helpers/form';
import BaseService from 'belt/core/js/helpers/service';

class TreeForm extends BaseForm {

    /**
     * Create a new Form instance.
     *
     * @param {object} options
     */
    constructor(options = {}) {
        super(options);
        this.menuGroupId = options.menuGroupId;

        let menuItem_id = null;
        if (options.menuItem.id) {
            menuItem_id = options.menuItem.id;
        }

        let baseUrl = `/api/v1/menu-items/${menuItem_id}/tree/`;
        this.service = new BaseService({baseUrl: baseUrl});

        // data
        this.setData({
            neighbor_id: '',
            move: '',
        });
    }

}

export default TreeForm;