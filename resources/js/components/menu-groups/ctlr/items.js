import shared from './shared';

// components
import menuItems from 'belt/menu/js/components/menu-items/ctlr/index';

export default {
    mixins: [shared],
    components: {
        tab: menuItems,
    },
}