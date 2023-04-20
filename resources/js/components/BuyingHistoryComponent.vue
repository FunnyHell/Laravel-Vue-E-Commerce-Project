<template>
    <div class="product-container" v-for="product in products">
        <a :href="'/product/'+product.id">
            <img :src="'/img'+product.path" class="product-image">
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

.product-image {
    display: inline-block;
    width: 20%;
}

.product {
    display: inline-block;
    vertical-align: top;
    margin-left: 10px;
}

.product span {
    width: 220px;
    display: flex;
    justify-content: space-between;;
}

.product span a {
    text-decoration: underline;
}

.product span a:hover {
    color: #3e9a8f;
}

.product-container {
    margin-bottom: 24px;
    padding: 7px;
    border: rgba(62, 154, 143, 0.46) 2px solid;
    border-radius: 24px;
}

.product-container img {
    border-radius: 16px;
}

.text-container {
    height: 110px;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
}

</style>
