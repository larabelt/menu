import parent from 'belt/menu/js/menu-groups/ctlr/shared';
import shared from 'belt/menu/js/menu-items/edit/shared';
import driver from 'belt/menu/js/menu-items/inputs/driver';
import parentId from 'belt/menu/js/menu-items/inputs/parent_id';
import html from 'belt/menu/js/menu-items/edit/index.html';

let component = {
    mixins: [shared],
    components: {
        edit: {
            mixins: [shared, parentId, driver],
            created() {
                this.loadMenuItem();
            },
            template: html
        },
    },
};

export default {
    mixins: [parent],
    components: {
        tab: component
    },
}