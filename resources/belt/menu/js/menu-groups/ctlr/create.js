// helpers
import Form from 'belt/menu/js/menu-groups/form';

// templates make a change
import heading_html from 'belt/core/js/templates/heading.html';
import form_html from 'belt/menu/js/menu-groups/templates/form.html';
import create_html from 'belt/menu/js/menu-groups/templates/create.html';

export default {
    components: {
        heading: {template: heading_html},
        create: {
            data() {
                return {
                    menuGroup: new Form({router: this.$router}),
                }
            },
            template: form_html,
        },
    },
    template: create_html
}