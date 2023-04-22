<template>
    <div class="splide" style="display: flex; align-items: center">
        <div class="splide__track" style="justify-content: center; text-align: center;">
            <splide :options="{rewind: true, direction: 'ttb', height: '430px', wheel: true, drag: true, perPage: 3 }">
                <splide-slide v-for="image in images">
                    <img :src="'/storage'+image.path" class="slide-img">
                </splide-slide>
                <splide-slide v-for="image in images">
                    <img :src="'/storage'+image.path" class="slide-img">
                </splide-slide>
                <splide-slide v-for="image in images">
                    <img :src="'/storage'+image.path" class="slide-img">
                </splide-slide>
            </splide>
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
