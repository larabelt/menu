import 'belt/menu/js/bootstrap/inputs';
import 'belt/menu/js/bootstrap/filters';
import 'belt/menu/js/bootstrap/functions';
import 'belt/menu/js/bootstrap/mixins';
import 'belt/menu/js/bootstrap/tiles';

import menuGroups  from 'belt/menu/js/menu-groups/routes';
import menuItems  from 'belt/menu/js/menu-items/routes';
import store from 'belt/core/js/store/index';

window.larabelt.menu = _.get(window, 'larabelt.menu', {});

export default class BeltMenu {

    constructor() {

        if ($('#belt-menu').length > 0) {

            const router = new VueRouter({
                mode: 'history',
                base: '/admin/belt/menu',
                routes: []
            });

            router.addRoutes(menuItems);
            router.addRoutes(menuGroups);

            new Vue({router, store}).$mount('#belt-menu');
        }
    }

}