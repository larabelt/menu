import menuGroups  from './components/menu-groups/routes';
import menuItems  from './components/menu-items/routes';
import store from 'belt/core/js/store/index';

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