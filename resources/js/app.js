import './bootstrap';
import { createApp } from 'vue';

const app = createApp({});

import InfiniteLoading from "v3-infinite-loading";

import ProductListComponent from "./components/ProductListComponent.vue";
import CategoriesComponent from "@/components/CategoriesComponent.vue";

app.component("infinite-loading", InfiniteLoading);

app.component('product-list', ProductListComponent);
app.component('categories', CategoriesComponent);

app.mount('#app');
