<template>
    <div>
        <b-button variant="success" type="submit" v-if="! isInCart" @click="addToCart">
        <b-icon-plus></b-icon-plus>
            ADD TO CART
        </b-button>
        <b-button variant="danger" type="submit" v-else @click="removeToCart">
            <b-icon-trash></b-icon-trash>    REMOVE TO CART
        </b-button>
        <b-button variant="primary" href="/cart">
            VIEW CART
        </b-button>
    </div>
</template>


<script>
    export default {
        props: ['productId', 'userId'],
        mounted () {
            this.checkIfInCart()
        },
        data () {
            return {
                isInCart: false,
            }
        },
        methods: {
            async checkIfInCart () {
                let result = await window.axios.get('/cart/exists/' + this.productId)

                this.isInCart = result.data
            },
            async removeToCart() {
                try {
                    await window.axios.delete('/cart/' + this.productId)
                    this.$bvToast.toast('Item has been removed to your cart.', {title: 'Success', variant: 'success'})
                    this.checkIfInCart()
                } catch (error) {
                    this.$bvToast.toast('Something went wrong.', {title: 'Error', variant: 'danger'})
                }
            },
            async addToCart () {
                try {
                    await window.axios.post('/cart', {user_id: this.userId, product_id: this.productId})
                    this.$bvToast.toast('Item has been added to your cart.', {title: 'Success', variant: 'success'})
                    this.checkIfInCart()
                } catch (error) {
                    this.$bvToast.toast('Something went wrong.', {title: 'Error', variant: 'danger'})
                }
            }
        }
    }
</script>
