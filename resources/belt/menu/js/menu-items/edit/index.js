import parent from 'belt/menu/js/menu-groups/ctlr/shared';
import shared from 'belt/menu/js/menu-items/edit/shared';
import TranslationStore from 'belt/core/js/translations/store/adapter';
import parentId from 'belt/menu/js/menu-items/inputs/parent_id';
import html from 'belt/menu/js/menu-items/edit/template.html';

let component = {
    mixins: [shared],
    components: {
        edit: {
            mixins: [shared, parentId, TranslationStore],
            data() {
                return {
                    entity_type: 'menu_items',
                    entity_id: this.$parent.entity_id,
                }
            },
            created() {
                this.bootTranslationStore();
                this.loadMenuItem();
            },
            methods: {
                submit() {
                    Events.$emit('menu_items:' + this.entity_id + ':updating', this.menuItem);
                    this.menuItem.submit();
                }
            },
            components: {

            },
            template: html
        },
    },
};

export default {
    mixins: [parent],
    components: {
        tab: component
    },
}