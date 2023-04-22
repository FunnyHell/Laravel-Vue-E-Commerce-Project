<template>
    <!--    <h1>{{ this.reviews }}</h1>-->
    <div v-for="review in reviews" class="review">
        <h2>{{ review.name }}</h2>
        <h3>{{ review.text }}</h3>
    </div>

    <div style="opacity: 0">]
        <infinite-loading :distance="0" @infinite="loadData"></infinite-loading>
    </div>
</template>

<script>
const currentPath = window.location.pathname;
export default {
    name: "ReviewComponent",
    props: ['id'],
    data() {
        return {
            reviews: [],
            page: 1
        }
    },
    methods: {
        loadData() {
            if (!this.finished) { // Если еще не все товары загружены
                axios.get('/api/product/' + this.id + '/reviews?page=' + this.page)
                    .then(response => {
                        this.reviews = this.reviews.concat(response.data.data);
                        this.page++;
                        if (response.data.data.length === 0) { // Если больше нет товаров
                            this.finished = true;
                        }
                    })
                    .catch(error => {
                        console.error(error);
                    });
            }
        }
    }

}
</script>

<style scoped>

.review {
    border: solid #cbd5e0 2px;
    margin: 12px;
    padding: 5px;
    border-radius: 12px
}

</style>
