import shared from 'belt/menu/js/components/menu-groups/ctlr/shared';

import select_html from '../templates/select.html';

export default {
    mixins: [shared],
    props: ['childMenuItem'],
    data() {
        return {
            loading: false,
            table: this.$parent.table,
            menuItem: this.$parent.menuItem,
            parentMenuItem: this.$parent.parentMenuItem,
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
    mounted() {
        this.loading = true;
        this.table.index()
            .then(() => {
                this.loading = false;
            });
    },
    template: select_html,
}