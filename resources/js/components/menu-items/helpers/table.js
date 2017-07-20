import BaseTable from 'belt/core/js/helpers/table';
import BaseService from 'belt/core/js/helpers/service';

class MenuItemTable extends BaseTable {

    constructor(options = {}) {
        super(options);
        this.menuGroupId = options.menuGroupId;
        let baseUrl = `/api/v1/menu-groups/${this.menuGroupId}/menu-items/`;
        this.service = new BaseService({baseUrl: baseUrl});
        this.query.perPage = 99999;
    }

}

export default MenuItemTable;