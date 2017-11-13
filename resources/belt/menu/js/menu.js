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

            const app = new Vue({router, store}).$mount('#belt-menu');
        }
    }

}