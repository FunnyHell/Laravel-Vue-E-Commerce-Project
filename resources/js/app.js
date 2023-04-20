import './bootstrap';
import { createApp } from 'vue';

const app = createApp({});

import InfiniteLoading from "v3-infinite-loading";
import { Splide, SplideSlide } from "@splidejs/vue-splide";

import ProductListComponent from "./components/ProductListComponent.vue";
import CategoriesComponent from "./components/CategoriesComponent.vue";
import ProductImagesCarouselComponent from "./components/ProductImagesCarouselComponent.vue";
import RecommendationProductComponent from "./components/RecommendationProductComponent.vue";
import BuyingHistoryComponent from "@/components/BuyingHistoryComponent.vue";
import SettingComponent from "@/components/SettingComponent.vue";

app.component("infinite-loading", InfiniteLoading);
app.component('splide', Splide);
app.component('splide-slide', SplideSlide);

app.component('product-list', ProductListComponent);
app.component('categories', CategoriesComponent);
app.component('product-image-carousel', ProductImagesCarouselComponent);
app.component('recommendation-products', RecommendationProductComponent);
app.component('buying-history', BuyingHistoryComponent);
app.component('setting', SettingComponent)

app.mount('#app');
