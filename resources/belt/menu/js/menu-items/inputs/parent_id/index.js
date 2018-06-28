import shared from 'belt/menu/js/menu-items/edit/shared';
import Table from 'belt/menu/js/menu-items/helpers/table';
import html from 'belt/menu/js/menu-items/inputs/parent_id/template.html';

export default {
    data() {
        return {
            search: false,
        }
    },
    created() {
        this.table = new Table({router: this.$router, menuGroupId: this.menuGroupId});
    },
    methods: {
        clearParentMenuItem() {
            this.search = false;
            this.menuItem.parent_id = null;
            this.parentMenuItem.reset();
        },
        toggle() {
            if (!this.search) {
                this.table.index();
            }
            this.search = !this.search;
        },
    },
    components: {
        parentId: {
            mixins: [shared],
            data() {
                return {
                    table: this.$parent.table,
                }
            },
            methods: {
                confirm(menuItem) {
                    if (menuItem.id != this.menuItem.id) {
                        this.$parent.search = false;
                        this.menuItem.parent_id = menuItem.id;
                        this.parentMenuItem.setData(menuItem);
                    }
                }
            },
            template: html,
        },
    },
}