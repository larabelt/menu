import menuGroup from 'belt/menu/js/menu-groups/ctlr/shared';
import parentId from 'belt/menu/js/menu-items/inputs/parent_id';
import Form from 'belt/menu/js/menu-items/helpers/form';
import html from 'belt/menu/js/menu-items/edit/index.html';

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
            template: html
        },
    },
}