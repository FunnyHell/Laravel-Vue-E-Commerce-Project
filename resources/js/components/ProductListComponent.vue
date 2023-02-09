<template>

    <div v-for="product in products" class="product-card">
        <a :href="/product/+product.id">
            <div>
                <div style="margin: 10px 10px 23px 10px"><img :src="'/img'+product.path" class="card-img"></div>
                <div class="row">
                    <div class="col">
                        <div class="row"><h3 class="title">{{ product.title }}</h3></div>
                        <div class="row"><h3 class="cost">{{ product.cost }} $</h3></div>
                    </div>
                    <div class="col"><h4 class="reviews">{{ product.reviews }} reviews</h4></div>
                </div>
            </div>
        </a>
    </div>
    <div style="opacity: 0">
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
                        console.log(response.data.data);
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

.product-card {
    display: inline-flex;
    text-align: center;
    justify-content: center;
    margin: 10px 12px;

    background: rgb(255, 255, 255);
    box-shadow: 1px 1px 4px rgba(0, 0, 0, 0.25);
    border-radius: 10px;
}

.card-img {
    object-fit: cover;
    height: 223px;
    border-radius: 5px;
}

h3 {
    color: rgb(0, 0, 0);
    font-family: Montserrat;
    font-size: 16px;
    font-weight: 400;
    line-height: 20px;
    letter-spacing: 0px;
}

h4 {
    color: rgb(0, 0, 0);
    font-family: Montserrat;
    font-size: 12px;
    font-weight: 400;
    line-height: 15px;
    letter-spacing: 0px;
}

.title .cost {
    text-align: left;
}

a {
    color: black;
    text-decoration: none;
}

.row > * {
    padding-left: 0;
}

.row {
    padding-left: 0;
    padding-right: 0;
    margin-right: 0;
}

.reviews {
    text-align: right;
}
</style>
