export default {
    data() {
        return {
            menuItem: this.$parent.menuItem,
            entity_type: 'menu_items',
            entity_id: this.$parent.entity_id,
        }
    },
    computed: {},
    methods: {
        menuId() {
            return this.$parent.entity_id;
        }
    },
}