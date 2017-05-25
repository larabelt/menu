import shared from './shared';

import form_html from '../templates/form.html';

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