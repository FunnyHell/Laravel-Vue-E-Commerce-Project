<template>
    <div class="splide" style="display: flex; align-items: center">
        <div class="splide__track" style="justify-content: center; text-align: center;">
            <splide :options="{rewind: true, direction: 'ttb', height: '430px', wheel: true, drag: true, perPage: 3 }">
                <splide-slide v-for="image in images">
                    <img :src="'/img'+image.path" class="slide-img">
                </splide-slide>
                <splide-slide v-for="image in images">
                    <img :src="'/img'+image.path" class="slide-img">
                </splide-slide>
                <splide-slide v-for="image in images">
                    <img :src="'/img'+image.path" class="slide-img">
                </splide-slide>
            </splide>
            <div style="position: relative">
                <div class="splide__arrows">
                    <button class="splide__arrow splide__arrow--prev">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 40" width="40" height="40"
                             focusable="false">
                            <path
                                d="m15.5 0.932-4.3 4.38 14.5 14.6-14.5 14.5 4.3 4.4 14.6-14.6 4.4-4.3-4.4-4.4-14.6-14.6z"></path>
                        </svg>
                    </button>
                    <button class="splide__arrow splide__arrow--next">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 40 40" width="40" height="40"
                             focusable="false">
                            <path
                                d="m15.5 0.932-4.3 4.38 14.5 14.6-14.5 14.5 4.3 4.4 14.6-14.6 4.4-4.3-4.4-4.4-14.6-14.6z"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
    </div>


</template>

<script>
import {Splide, SplideSlide} from '@splidejs/vue-splide';


export default {
    name: "ProductImagesCarouselComponent",
    props: ['id'],
    components: {
        Splide,
        SplideSlide,
    },
    data: function () {
        return {
            images: []
        }
    },
    mounted() {
        axios.get(`/api/product/${this.id}/images`)
            .then(responce => {
                this.images = responce.data;
                console.log(this.images);
            })
            .catch(error => {
                console.error(error);
            })
    }
}

</script>

<style scoped>


.slide-img {
    height: 132px;
}

.splide__track {
    height: 430px;
}

.splide__slide {
    margin-bottom: 5px;
}


</style>
