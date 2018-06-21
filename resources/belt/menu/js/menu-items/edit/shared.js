import Form from 'belt/menu/js/menu-items/helpers/form';
import html from 'belt/menu/js/menu-items/edit/shared.html';

export default {
    data() {

        let config = this.$parent.config ? this.$parent.config : {};
        let menuGroupId = this.$parent.menuGroupId ? this.$parent.menuGroupId : this.$route.params.menuGroupId;
        let menuItem = this.$parent.menuItem ? this.$parent.menuItem : new Form({menuGroupId: menuGroupId});
        let morphable_id = this.$parent.morphable_id ? this.$parent.morphable_id : this.$route.params.menuItemId;
        let parentMenuItem = this.$parent.parentMenuItem ? this.$parent.parentMenuItem : new Form({menuGroupId: menuGroupId});
        let plugin = this.$parent.plugin ? this.$parent.plugin : {template: `<span></span>`};

        return {
            config: config,
            menuGroupId: menuGroupId,
            menuItem: menuItem,
            morphable_type: 'menu-items',
            morphable_id: morphable_id,
            parentMenuItem: parentMenuItem,
            plugin: plugin,
        }
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