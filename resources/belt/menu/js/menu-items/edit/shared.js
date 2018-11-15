import Form from 'belt/menu/js/menu-items/helpers/form';
import html from 'belt/menu/js/menu-items/edit/shared.html';

export default {
    data() {

        let menuGroupId = this.$parent.menuGroupId ? this.$parent.menuGroupId : this.$route.params.menuGroupId;
        let menuItem = this.$parent.menuItem ? this.$parent.menuItem : new Form({menuGroupId: menuGroupId});
        let entity_id = this.$parent.entity_id ? this.$parent.entity_id : this.$route.params.menuItemId;
        let parentMenuItem = this.$parent.parentMenuItem ? this.$parent.parentMenuItem : new Form({menuGroupId: menuGroupId});

        return {
            menuGroupId: menuGroupId,
            menuItem: menuItem,
            entity_type: 'menu_items',
            entity_id: entity_id,
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
        displayLabel() {
            return _.includes(this.display, 'label', false);
        },
        displayTarget() {
            return _.includes(this.display, 'target', false);
        },
        displayUrl() {
            return _.includes(this.display, 'url', false);
        },
        form() {
            return this.menuItem;
        },
    },
    methods: {
        loadMenuItem() {
            this.menuItem.show(this.entity_id)
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