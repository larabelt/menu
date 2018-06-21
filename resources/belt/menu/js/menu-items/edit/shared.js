import Form from 'belt/menu/js/menu-items/helpers/form';
import html from 'belt/menu/js/menu-items/edit/shared.html';

export default {
    data() {

        let menuGroupId = this.$parent.menuGroupId ? this.$parent.menuGroupId : this.$route.params.menuGroupId;
        let menuItem = this.$parent.menuItem ? this.$parent.menuItem : new Form({menuGroupId: menuGroupId});
        let morphable_id = this.$parent.morphable_id ? this.$parent.morphable_id : this.$route.params.menuItemId;
        let parentMenuItem = this.$parent.parentMenuItem ? this.$parent.parentMenuItem : new Form({menuGroupId: menuGroupId});

        return {
            menuGroupId: menuGroupId,
            menuItem: menuItem,
            morphable_type: 'menu-items',
            morphable_id: morphable_id,
            parentMenuItem: parentMenuItem,
        }
    },
    computed: {
        config() {
            return this.menuItem.config;
        },
        display() {
            return _.get(this.config, 'display', []);
        },
        displayTarget() {
            return _.includes(this.display, 'target', false);
        },
        displayUrl() {
            return _.includes(this.display, 'url', false);
        },
    },
    methods: {
        loadMenuItem() {
            this.menuItem.show(this.morphable_id)
                .then(() => {
                    // parent menu item
                    if (this.menuItem.parent_id) {
                        this.parentMenuItem.show(this.menuItem.parent_id);
                    }
                });
        }
    },
    template: html,
}