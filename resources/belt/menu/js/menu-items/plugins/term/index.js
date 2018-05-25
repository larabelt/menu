import shared from 'belt/menu/js/menu-items/plugins/default/shared';
import term from 'belt/menu/js/menu-items/plugins/term/term';
import showChildren from 'belt/menu/js/menu-items/plugins/term/show_children';
import html from 'belt/menu/js/menu-items/plugins/term/index.html';

export default {
    mixins: [shared],
    components: {
        term,
        showChildren
    },
    template: html
}