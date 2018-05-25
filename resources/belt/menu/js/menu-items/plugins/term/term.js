import shared from 'belt/menu/js/menu-items/plugins/default/shared';
import terms from 'belt/content/js/terms/ctlr/index-table';
import TermForm from 'belt/content/js/terms/form';
import TermTable from 'belt/content/js/terms/table';
import ParamForm from 'belt/core/js/paramables/form';
import html from 'belt/menu/js/menu-items/plugins/term/term.html';

export default {
    mixins: [shared],
    data() {
        return {
            term: new TermForm(),
            param: new ParamForm({
                morphable_type: 'menu_items',
                morphable_id: this.menuId(),
                key: 'terms'
            }),
            table: new TermTable(),
            search: false,
        }
    },
    mounted() {
        this.param.show('terms')
            .then((response) => {
                this.term.show(response.value);
            })
            .catch(() => {

            });
    },
    computed: {},
    methods: {
        clearTerm() {
            this.param.value = '';
            this.param.submit();
            this.term.reset();
            this.search = false;
        },
        toggle() {
            if (!this.search) {
                this.table.index();
            }
            this.search = !this.search;
        },
    },
    components: {
        terms: {
            mixins: [terms],
            methods: {
                confirm(term) {
                    if (term.id != this.$parent.param.id) {
                        this.$parent.param.value = term.id;
                        this.$parent.param.submit();
                        this.$parent.term.show(term.id);
                        this.$parent.search = false;
                        this.$parent.menuItem.label = '';
                        this.$parent.menuItem.url = '';
                        this.$parent.menuItem.submit();
                    }
                }
            }
        }
    },
    template: html
}