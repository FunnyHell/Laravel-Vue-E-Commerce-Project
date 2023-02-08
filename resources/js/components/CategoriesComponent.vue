<template>

</template>

<script>
export default {
    name: "CategoriesComponent",
    data: function (){
        return {
            components: []
        }
    },
    mounted() {
        axios.get('api/categories')
    }


}
</script>

<style scoped>

</style>
