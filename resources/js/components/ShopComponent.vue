<template>
    <div class="row">
        <ul class="product-list grid-products equal-container">
            <li class="col-lg-4 col-md-6 col-sm-6 col-xs-6 " v-for="product in products"  :key="product.id">
                <div class="product product-style-3 equal-elem ">
                    <div class="product-thumnail">
                        <a :href="'details/' + product.id" :title="product.name">
                            <figure><img :src="'assets/images/products/' + product.image" :alt="product.name"></figure>
                        </a>
                    </div>
                    <div class="product-info">
                        <a href="#" class="product-name"><span>{{product.name}}</span></a>
                        <div class="wrap-price"><span class="product-price">{{product.price}}</span></div>
                        <div class="wrap-footer-item footer-item-second">
                            <div class="item-content">
                                <div class="wrap-newletter-footer">
                                    <button @click="addToCart($event)" :name="product.id" class="btn add-to-cart">Add To Cart</button>
                                </div>
                            </div>
                        </div>
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
                products: [],
                loading: true,
                user_id: this.$userId,
            }
        },

        mounted() {
            this.loadProducts();
        },
        methods: {
            loadProducts: function () {
                axios.get('/api/products/')
                    .then((response) => {
                        this.products = response.data.data;
                        let numFormat = new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'EUR' });
                        this.products.forEach(product => {
                            product.price = numFormat.format(product.price);
                        });
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            addToCart: function (e) {
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
