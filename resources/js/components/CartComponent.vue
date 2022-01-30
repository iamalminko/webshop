<template>
    <div class=" main-content-area">
            <div class="wrap-iten-in-cart">
                <h3 class="box-title">Products Name</h3>
                <ul class="products-cart">
                    <li class="pr-cart-item" v-for="product in products"  :key="product.id">
                        <div class="product-image">
                            <figure><img :src="'assets/images/products/' + product.product.image" alt=""></figure>
                        </div>
                        <div class="product-name">
                            <a href="">{{product.product.name}}</a>
                        </div>
                        <div class="price-field produtc-price"><p class="price">{{product.product.price}}</p></div>
                        <div class="quantity">
                            <!-- Change amount of certain product in Cart -->
                            <div class="quantity-input">
                                <input type="text" name="product-quatity" :value="product.amount" data-max="120" pattern="[0-9]*" >
                                <button class="btn btn-increase" :name="product.id" value="1" @click="changeAmount($event)" v-bind:style="{cursor: selectedCursor}"></button>
                                <button class="btn btn-reduce"  :name="product.id" value="-1" @click="changeAmount($event)" v-bind:style="{cursor: selectedCursor}"></button>
                            </div>
                        </div>
                        <div class="price-field sub-total"><p class="price">{{product.sum}}</p></div>
                        <div class="delete">
                            <!-- Button to remove product from cart. X icon is shown on screen -->
                            <button class="btn btn-delete" title="" :name="product.id" @click="removeFromCart($event)" v-bind:style="{cursor: selectedCursor}">
                                <i class="fa fa-times-circle" aria-hidden="true"></i>
                            </button>
                        </div>
                    </li>											
                </ul>
            </div>
            <!-- Code from template, not functional -->
            <div class="summary">
                <div class="order-summary">
                    <h4 class="title-box">Order Summary</h4>
                    <p class="summary-info"><span class="title">Subtotal</span><b class="index">{{subtotal}}</b></p>
                    <p class="summary-info"><span class="title">Shipping</span><b class="index">Free Shipping</b></p>
                    <p class="summary-info total-info "><span class="title">Total</span><b class="index">{{subtotal}}</b></p>
                </div>
                <div class="checkout-info">
                    <label class="checkbox-field">
                        <input class="frm-input " name="have-code" id="have-code" value="" type="checkbox"><span>I have promo code</span>
                    </label>
                    <a class="btn btn-checkout" href="checkout.html">Check out</a>
                    <a class="link-to-shop" href="shop.html">Continue Shopping<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
                </div>
                <div class="update-clear">
                    <a class="btn btn-clear" href="#">Clear Shopping Cart</a>
                    <a class="btn btn-update" href="#">Update Shopping Cart</a>
                </div>
            </div>
    </div>
</template>

<script>
    export default {
        data: function () {
            return {
                loading: true,
                products: [],
                subtotal: 0,
                user_id: this.$userId,
                selectedCursor: 'default',
            }
        },

        mounted() {
            this.loadCart();
        },
        methods: {
            // Loads a list of products and renders HTML accordingly.
            // This method is invoked every time we send API request through changeAmount, removeFromCart
            loadCart: function () {
                axios.get('/api/cart/' + this.user_id)
                    .then((response) => {
                        this.products = response.data.data;
                        let numFormat = new Intl.NumberFormat('de-DE', { style: 'currency', currency: 'EUR' });
                        this.subtotal = 0;
                        this.products.forEach(product => {
                            this.subtotal += product.product.price * product.amount;
                            product.sum = numFormat.format(product.product.price * product.amount);
                            product.product.price = numFormat.format(product.product.price);
                        });
                        this.subtotal = numFormat.format(this.subtotal);
                        this.loading = false;
                        this.selectedCursor = 'default';
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
            // Send API request and change amount of certain product in user's cart
            changeAmount(e) {
                this.selectedCursor = 'wait';
                axios.get('/api/changeAmount/' + e.target.name + '/' + e.target.value)
                    .then((response) => {
                        this.loadCart();
                    })
                    .catch(function (error) {
                        console.log(error);
                });
                this.loadCart();
            },
            // Send API request and remove certain product from user's cart
            removeFromCart(e) {
                this.selectedCursor = 'wait';
                axios.get('/api/removeFromCart/' + e.target.parentElement.name)
                    .then((response) => {
                        this.loadCart();
                    })
                    .catch(function (error) {
                        console.log(error);
                    });
            },
        }
    }
</script>
