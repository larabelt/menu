import menuGroup from 'belt/menu/js/menu-groups/ctlr/shared';
import parentId from 'belt/menu/js/menu-items/inputs/parent_id';
import subtypeDropdown from 'belt/content/js/subtypes/inputs/default';
import Form from 'belt/menu/js/menu-items/helpers/form';
import html from 'belt/menu/js/menu-items/create/template.html';

export default {
    mixins: [menuGroup],
    components: {
        tab: {
            mixins: [parentId],
            data() {
                let menuGroupId = this.$route.params.menuGroupId;
                return {
                    menuGroupId: menuGroupId,
                    menuItem: new Form({router: this.$router, menuGroupId: menuGroupId}),
                    parentMenuItem: new Form({router: this.$router, menuGroupId: menuGroupId}),
                }
            },
            methods: {
                submit() {
                    Events.$emit('menu_items:' + this.entity_id + ':saving', this.menuItem);
                    this.menuItem.submit();
                }
            },
            components: {
                subtypeDropdown,
            },
            template: html
        },
    },
}