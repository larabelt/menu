import index from './ctlr/index';
import create from './ctlr/create';
import edit  from './ctlr/edit';

export default [
    {path: '/menu-groups', component: index, canReuse: false, name: 'menuGroups'},
    {path: '/menu-groups/create', component: create, name: 'menuGroups.create'},
    {path: '/menu-groups/edit/:menuGroupId', component: edit, name: 'menuGroups.edit'},
]