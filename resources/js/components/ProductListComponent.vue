<template>
    <div class="container">

        <div v-for="product in products" class="product-card">
            <img src="resources/img/placeholder.png" alt="Product image">
            <h3>{{ product.title }}</h3>
            <h3>{{ product.cost }}</h3>
        </div>
        <infinite-loading :distance="0" @infinite="loadData"></infinite-loading>
    </div>
</template>

<script>
import InfiniteLoading from "v3-infinite-loading";

export default {
    name: "ProductListComponent",
    components: {
        InfiniteLoading
    },
    data: function () {
        return {
            products: [],
            page: 1,
            finished: false
        }
    },
    methods: {
        loadData() {
            if (!this.finished) {
                axios.get('/api/products?page=' + this.page)
                    .then(response => {
                        this.products = this.products.concat(response.data.data);
                        console.log(this.products);
                        this.page++;
                        if (response.data.data.length === 0) {
                            this.finished = true;
                        }
                    })
                    .catch(error => {
                        console.error(error);
                    })
            }
        }
    }
}
</script>

<style scoped>

</style>
