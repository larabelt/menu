import parent from 'belt/menu/js/menu-groups/ctlr/shared';
import shared from 'belt/menu/js/menu-items/edit/shared';
import templateDropdown from 'belt/content/js/templates/inputs/default';
import parentId from 'belt/menu/js/menu-items/inputs/parent_id';
import html from 'belt/menu/js/menu-items/edit/template.html';

let component = {
    mixins: [shared],
    components: {
        edit: {
            mixins: [shared, parentId],
            created() {
                this.loadMenuItem();
            },
            methods: {
                submit() {
                    Events.$emit('menu_items:' + this.morphable_id + ':updating', this.menuItem);
                    this.menuItem.submit();
                }
            },
            components: {
                templateDropdown,
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