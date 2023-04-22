<template>
    <div class="product-container" v-for="product in products">
        <a :href="'/product/'+product.id">
            <img :src="'/storage/'+product.path" class="product-image">
            <div class="product">
                <div class="text-container">
                    <span>
                        <h2>{{ product.title }}</h2>
                        <h2>{{ product.cost }}$</h2>
                    </span>
                    <span>
                        <h3>{{ product.rating }}/10</h3>
                        <h3><a :href="'/seller/'+product.seller_id">{{ product.name }}</a></h3>
                    </span>
                </div>
            </div>
        </a>
    </div>
</template>

<script>
import {error} from "@splidejs/splide/src/js/utils";

export default {
    name: "BuyingHistoryComponent",
    props: ['id'],
    data() {
        return {
            products: []
        }
    },
    mounted() {
        axios.get(`/api/user-history-products/${this.id}`)
            .then(responce => {
                this.products = responce.data;
                console.log(responce);
            })
            .catch(error => {
                console.error(error);
            })
    }
}

</script>

<style scoped>

</style>
