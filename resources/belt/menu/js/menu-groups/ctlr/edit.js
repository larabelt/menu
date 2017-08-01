import shared from 'belt/menu/js/menu-groups/ctlr/shared';

import form_html from 'belt/menu/js/menu-groups/templates/form.html';

export default {
    mixins: [shared],
    components: {
        tab: {
            data() {
                return {
                    menuGroup: this.$parent.menuGroup,
                }
            },
            template: form_html,
        },
    },
}