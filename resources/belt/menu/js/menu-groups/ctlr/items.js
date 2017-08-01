import shared from 'belt/menu/js/menu-groups/ctlr/shared';

// components
import menuItems from 'belt/menu/js/menu-items/ctlr/index';

export default {
    mixins: [shared],
    components: {
        tab: menuItems,
    },
}