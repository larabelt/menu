import shared from 'belt/menu/js/components/menu-groups/ctlr/shared';
import MenuItemForm from '../form';
import form_html from '../templates/form.html';

export default {
    mixins: [shared],
    components: {
        tab: {
            data() {
                return {
                    menuItem: new MenuItemForm({router: this.$router, menuGroupId: this.$parent.menuGroupId}),
                    menuItemId: this.$route.params.menuItemId,
                }
            },
            template: form_html,
        },
    },
}