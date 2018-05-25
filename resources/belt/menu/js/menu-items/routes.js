import index  from 'belt/menu/js/menu-items/index';
import create  from 'belt/menu/js/menu-items/create';
import edit  from 'belt/menu/js/menu-items/edit';
import params  from 'belt/menu/js/menu-items/edit/params';

// plugins
import pluginMenuItemDefault from 'belt/menu/js/menu-items/plugins/default';
import pluginMenuItemTerm from 'belt/menu/js/menu-items/plugins/term';

Vue.component('plugin-menu-item-default', function (resolve, reject) {
    setTimeout(function () {
        resolve(pluginMenuItemDefault)
    }, 1000);
});
Vue.component('plugin-menu-item-term', function (resolve, reject) {
    setTimeout(function () {
        resolve(pluginMenuItemTerm)
    }, 1000);
});

export default [
    {path: '/menu-groups/edit/:menuGroupId/menu-items', component: index, name: 'menuItems'},
    {path: '/menu-groups/edit/:menuGroupId/menu-items/create', component: create, name: 'menuItems.create'},
    {path: '/menu-groups/edit/:menuGroupId/menu-items/edit/:menuItemId', component: edit, name: 'menuItems.edit'},
    {path: '/menu-groups/edit/:menuGroupId/menu-items/edit/:menuItemId/params', component: params, name: 'menuItems.params'},
]