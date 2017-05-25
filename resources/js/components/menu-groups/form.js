import BaseForm from 'belt/core/js/helpers/form';
import BaseService from 'belt/core/js/helpers/service';

class MenuGroupForm extends BaseForm {

    constructor(options = {}) {
        super(options);
        this.service = new BaseService({baseUrl: '/api/v1/menu-groups/'});
        //this.routeEditName = 'menuGroups.edit';
        this.setData({
            id: '',
            is_active: 0,
            name: '',
            slug: '',
            heading: '',
            body: '',
        })
    }

    store() {
        super.store()
            .then(() => {
                this.router.push({name: 'menuGroups.edit', params: {menuGroupId: this.id}})
            })
    }

}

export default MenuGroupForm;