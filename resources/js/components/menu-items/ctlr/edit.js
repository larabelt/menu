import shared from 'belt/menu/js/components/menu-groups/ctlr/shared';
import selectParent from 'belt/menu/js/components/menu-items/ctlr/select';
import Table from '../table';
import MenuItemForm from '../form';
import form_html from '../templates/form.html';

export default {
    mixins: [shared],
    components: {
        tab: {
            data() {
                return {
                    menuItem: new MenuItemForm({menuGroupId: this.$parent.menuGroupId}),
                    menuItemId: this.$route.params.menuItemId,
                    parentMenuItem: new MenuItemForm({menuGroupId: this.$parent.menuGroupId}),
                    search: false,
                    table: new Table({router: this.$router, menuGroupId: this.$parent.menuGroupId}),
                }
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
            mounted() {
                this.menuItem.show(this.menuItemId)
                    .then(() => {
                        if (this.menuItem.parent_id) {
                            console.log('parent');
                            this.parentMenuItem.show(this.menuItem.parent_id);
                        }
                    });
            },
            components: {
                selectParent: {
                    mixins: [selectParent],
                    methods: {
                        // confirm(menuItem) {
                        //     if (menuItem.id != this.$parent.form.parent_id) {
                        //         this.$parent.form.parent_id = menuItem.id;
                        //         this.$parent.search = false;
                        //         this.$parent.parentMenuItem.setData(menuItem);
                        //     }
                        // }
                    }
                }
            },
            template: form_html,
        },
    },
}