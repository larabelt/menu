import index from 'belt/menu/js/menu-groups/ctlr/index';
import create from 'belt/menu/js/menu-groups/ctlr/create';
import edit  from 'belt/menu/js/menu-groups/ctlr/edit';

export default [
    {path: '/menu-groups', component: index, canReuse: false, name: 'menuGroups'},
    {path: '/menu-groups/create', component: create, name: 'menuGroups.create'},
    {path: '/menu-groups/edit/:menuGroupId', component: edit, name: 'menuGroups.edit'},
]