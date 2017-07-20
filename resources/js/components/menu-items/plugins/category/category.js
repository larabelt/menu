import shared from 'belt/menu/js/components/menu-items/plugins/default/shared';
import categories from 'belt/glue/js/components/categories/ctlr/index-table';
import CategoryForm from 'belt/glue/js/components/categories/form';
import CategoryTable from 'belt/glue/js/components/categories/table';
import ParamForm from 'belt/core/js/components/paramables/form';
import html from 'belt/menu/js/components/menu-items/plugins/category/category.html';

export default {
    mixins: [shared],
    data() {
        return {
            category: new CategoryForm(),
            param: new ParamForm({
                morphable_type: 'menu-items',
                morphable_id: this.menuId(),
                key: 'categories'
            }),
            table: new CategoryTable(),
            search: false,
        }
    },
    mounted() {
        this.param.show('categories')
            .then((response) => {
                this.category.show(response.value);
            })
            .catch(() => {

            });
    },
    computed: {},
    methods: {
        clearCategory() {
            this.param.value = '';
            this.param.submit();
            this.category.reset();
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
        categories: {
            mixins: [categories],
            methods: {
                confirm(category) {
                    if (category.id != this.$parent.param.id) {
                        this.$parent.param.value = category.id;
                        this.$parent.param.submit();
                        this.$parent.category.show(category.id);
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