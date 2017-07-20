export default {
    data() {
        return {
            menuItem: this.$parent.menuItem,
            morphable_type: 'menu-items',
            morphable_id: this.$parent.morphable_id,
        }
    },
    computed: {},
    methods: {
        menuId() {
            return this.$parent.morphable_id;
        }
    },
}