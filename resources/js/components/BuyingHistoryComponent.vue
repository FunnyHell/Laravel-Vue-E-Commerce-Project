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
        <form :action="'/add-rating/'+product.id" method="post">
            <csrf-token-input></csrf-token-input>
            <input type="hidden" name="_token" :value="csrf"/>
            <select name="rating[]" id="rating">
                <option value="1">1</option>
                <option value="2">2</option>
                <option value="3">3</option>
                <option value="4">4</option>
                <option value="5">5</option>
                <option value="6">6</option>
                <option value="7">7</option>
                <option value="8">8</option>
                <option value="9">9</option>
                <option value="10">10</option>
            </select>
            <input type="submit" class="cancel" value="Rate" name="rate"/>
        </form>
    </div>
</template>

<script>
import {error} from "@splidejs/splide/src/js/utils";

export default {
    name: "BuyingHistoryComponent",
    props: ['id', 'csrf'],
    data() {
        return {
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            products: []
        }
    },
    mounted() {
        axios.interceptors.request.use(config => {
            config.headers['X-CSRF-TOKEN'] = this.csrf;
            return config;
            console.log(config);
        });

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
