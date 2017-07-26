import shared from 'belt/menu/js/components/menu-groups/ctlr/shared';

// components
import menuItems from 'belt/menu/js/components/menu-items/ctlr/index';

export default {
    mixins: [shared],
    components: {
        tab: menuItems,
    },
}