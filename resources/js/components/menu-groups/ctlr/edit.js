import shared from 'belt/menu/js/components/menu-groups/ctlr/shared';

import form_html from 'belt/menu/js/components/menu-groups/templates/form.html';

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