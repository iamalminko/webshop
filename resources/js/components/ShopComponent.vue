<template>
    <div class="row" :class="{'loading': loading}" v-bind:style="{cursor: selectedCursor}">
        <ul class="product-list grid-products equal-container">
            <li class="col-lg-4 col-md-6 col-sm-6 col-xs-6 " v-for="product in products"  :key="product.id">
                <div class="product product-style-3 equal-elem ">
                    <div class="product-thumnail">
                        <a :href="'details/' + product.id" :title="product.name">
                            <figure><img :src="'assets/images/products/' + product.image" :alt="product.name"></figure>
                        </a>
                    </div>
                    <!-- add to cart - sends API request -->
                    <div class="product-info">
                        <a href="#" class="product-name"><span>{{product.name}}</span></a>
                        <div class="wrap-price"><span class="product-price">{{product.price}}</span></div>
                        <button @click="addToCart($event)" :name="product.id" class="btn add-to-cart" v-bind:style="{cursor: selectedCursor}">Add To Cart</button>
                    </div>

                </div>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                loading: true,
                products: [],
                user_id: this.$userId,
                selectedCursor: 'default',
            }
        },

        mounted() {
            this.loadProducts();
        },
        methods: {
            // Loads a list of products and renders HTML accordingly.
            // This method is invoked every time we send API request through addToCart
            loadProducts: function () {
                axios.get('/api/products/')
                    .then((response) => {
                        this.products = response.data.data;
                        let numFormat = new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'EUR' });
                        this.products.forEach(product => {
                            product.price = numFormat.format(product.price);
                        });
                        this.loading = false;
                        this.selectedCursor = 'default';
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            // Send API request and add certain product to user's cart
            // We are sending user_id because Auth is not yet implemented for Vue.js requests. Laravel/Blade requests have Auth implemented
            addToCart: function (e) {
                this.selectedCursor = 'wait';
                axios.get('/api/addToCart/' + this.user_id + '/' + e.target.name)
                    .then((response) => {
                        this.loadProducts();
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            }
        }
    }
</script>
