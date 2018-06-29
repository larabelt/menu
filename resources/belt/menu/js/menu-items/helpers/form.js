import BaseForm from 'belt/core/js/helpers/form';
import BaseService from 'belt/core/js/helpers/service';

class MenuItemForm extends BaseForm {

    constructor(options = {}) {
        super(options);

        this.menuGroupId = options.menuGroupId;

        let baseUrl = `/api/v1/menu-groups/${this.menuGroupId}/menu-items/`;
        this.service = new BaseService({baseUrl: baseUrl});
        this.setData({
            id: '',
            template: '',
            parent_id: null,
            name: '',
            url: '',
            target: '',
            slug: '',
            ancestors: [],
        })
    }

    store() {
        super.store()
            .then(() => {
                this.router.push({
                    name: 'menuItems.edit',
                    params: {
                        menuGroupId: this.menuGroupId,
                        menuItemId: this.id,
                    }
                })
            });
    }

    fullName() {
        let names = this.ancestors.concat(this.name);
        return names.join(' > ');
    }

}

export default MenuItemForm;