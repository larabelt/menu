import shared from 'belt/menu/js/menu-items/plugins/default/shared';
import ParamForm from 'belt/core/js/paramables/form';
import html from 'belt/menu/js/menu-items/plugins/term/show_children.html';

export default {
    mixins: [shared],
    data() {
        return {
            param: new ParamForm({
                morphable_type: 'menu_items',
                morphable_id: this.menuId(),
                key: 'show_children'
            }),
        }
    },
    mounted() {
        this.param.show('show_children')
            .then((response) => {

            })
            .catch(() => {

            });
    },
    computed: {},
    methods: {

    },
    template: html
}