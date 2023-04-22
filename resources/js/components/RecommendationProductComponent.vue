<template>
    <div>
        <splide ref="splide" :options="splideOption">
            <splide-slide v-for="product in products">
                <div class="card" style="margin: 10px; min-width: fit-content">
                    <a :href="'/product/'+product.id">
                        <div style="text-align: center;">
                            <img :src="'/storage'+product.path" class="card-img">
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
    data() {
        return {
            products: [],
            splideOption: {
                rewind: true,
                drag: true,
                perPage: 3,
                autoplay: true,
                pagination: false
            }
        }
    },
    mounted() {
        const breakpoints = {
            1401: {perPage: 3},
            1400: {perPage: 2},
            992: {perPage: 1},
        };
        const splide = this.$refs.splide.splide;
        this.$nextTick(() => {
            Object.keys(breakpoints).forEach((breakpoint) => {
                const media = window.matchMedia(`(max-width: ${breakpoint}px)`);
                const {perPage} = breakpoints[breakpoint];
                const setPerPage = () => {
                    splide.options.perPage = perPage;
                    splide.refresh();
                };
                media.addListener(setPerPage);
                setPerPage();
            });
        });

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
