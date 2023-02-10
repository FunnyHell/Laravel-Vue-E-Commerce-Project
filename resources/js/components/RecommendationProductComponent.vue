<template>
    <div>
        <splide :options="{rewind: true, drag: true, perPage: 3, autoplay: true, pagination: false}">
            <splide-slide v-for="product in products">
                <div class="card" style="margin-right: 8px; margin-left: 9px; ">
                    <a :href="'/product/'+product.id">
                        <div style="text-align: center;">
                            <img :src="'/img'+product.path" class="card-img">
                        </div>
                        <h2 class="card-text">{{ product.title }}</h2>
                        <h2 class="card-text">{{ product.cost }}$</h2>
                    </a>
                </div>
            </splide-slide>
        </splide>
    </div>
</template>

<script>
import axios from "axios";
import {Splide, SplideSlide} from '@splidejs/vue-splide';


export default {
    name: "RecomendationProductComponent",
    props: ['id'],
    components: {
        Splide,
        SplideSlide,
    },
    data: function () {
        return {
            products: []
        }
    },
    mounted() {
        axios.get(`/api/random-products/${this.id}`)
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

.card-img {
    margin-top: 10px;
    height: 110px;
    width: 110px;
    border-radius: 1px;
}

.card-text {
    margin: 10px 10px 5px;
}

</style>
