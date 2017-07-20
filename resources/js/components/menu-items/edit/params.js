import parent from 'belt/menu/js/components/menu-groups/ctlr/shared';
import shared from 'belt/menu/js/components/menu-items/edit/shared';
import html from 'belt/menu/js/components/menu-items/edit/params.html';

let component = {
    mixins: [shared],
    components: {
        edit: {
            mixins: [shared],
            created() {
                this.loadMenuItem();
            },
            template: html
        },
    },
};


export default {
    mixins: [parent],
    components: {
        tab: component
    },
}