<template>
    <ul>
        <template v-for="component in components">
            <li v-if="component.parent_id == null" class="dropdown-item">
                <hr v-if="component.id != 1" class="dropdown-divider">
                <h2>
                    <a :href="/category/+component.name.toLowerCase()">
                        {{ component.name }}
                    </a>
                </h2>
            </li>
            <li v-if="component.parent_id != null" class="dropdown-item">
                <ul>
                    <li>
                        <h3>{{ component.name }}</h3>
                    </li>
                </ul>
            </li>

        </template>
    </ul>
</template>

<script>
export default {
    name: "CategoriesComponent",
    data: function () {
        return {
            components: []
        }
    },
    mounted() {
        axios.get('/api/categories')
            .then(responce => {
                this.components = responce.data;
            })
            .catch(error => {
                console.error(error);
            })
    }


}
</script>

<style scoped>
li {
    list-style-type: none;
}
</style>
