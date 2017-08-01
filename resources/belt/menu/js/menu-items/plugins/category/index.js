import shared from 'belt/menu/js/menu-items/plugins/default/shared';
import category from 'belt/menu/js/menu-items/plugins/category/category';
import showChildren from 'belt/menu/js/menu-items/plugins/category/show_children';
import html from 'belt/menu/js/menu-items/plugins/category/index.html';

export default {
    mixins: [shared],
    components: {
        category,
        showChildren
    },
    template: html
}