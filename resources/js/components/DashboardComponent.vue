<template>
    <div class="row" :class="{'loading': loading}" v-bind:style="{cursor: selectedCursor}">
        <ul class="product-list grid-products equal-container"  v-for="product in products"  :key="product.id">
            <li class="col-lg-4 col-md-6 col-sm-6 col-xs-6 ">
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
                                <!-- set discount - number input and button to send API request -->
                                <div class="wrap-newletter-footer">
                                    <form class="frm-newletter" id="frm-newletter" @submit.prevent="submitPressed">
                                        <input type="number" class="input-discount" name="discount" :value="product.discount" placeholder="Discount">
                                        <input type="submit" :name="product.id" value="Set Discount" class="btn-submit" v-bind:style="{cursor: selectedCursor}">
                                    </form>
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
                loading: true,
                products: [],
                loading: true,
                user_id: this.$userId,
                selectedCursor: 'default',
            }
        },

        mounted() {
            this.loadProducts();
        },
        methods: {
            // Loads a list of products and renders HTML accordingly.
            // This method is invoked every time we send API request through submitPressed
            loadProducts: function () {
                axios.get('/api/products/')
                    .then((response) => {
                        this.products = response.data.data;
                        let numFormat = new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'EUR' });
                        this.products.forEach(product => {
                            product.price = numFormat.format(product.price);
                            product.discount = product.discount/100;
                        });
                        this.loading = false;
                        this.selectedCursor = 'default';
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            // Send API request and update discount for certain product
            submitPressed: function(e) {
                this.selectedCursor = 'wait';
                axios.get('/api/setDiscount/' + this.user_id + '/' + e.submitter.name + '/' + parseInt(e.target.elements.discount.value*100))
                    .then((response) => {
                        this.loadProducts();
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
        }
    }
</script>
