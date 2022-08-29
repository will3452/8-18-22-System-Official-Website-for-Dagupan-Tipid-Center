<template>
    <b-row center>
            <b-col :sm="6" :xs="12" :md="3" v-for="i in products" :key="i" class="mt-4">
                <b-card :img-src="i.image | image">
                    <b-card-text class="text-center">
                        <div class="text-lg">{{i.name}}</div>
                       <div class="font-bold p-2 rounded text-warning" style="font-weight:900">{{i.price | currency}}</div>
                        <b-button variant="success" size="sm" @click="addToCart(i.id)">
                            <b-icon-plus></b-icon-plus>
                            Add to cart
                            </b-button>
                    </b-card-text>
                </b-card>
            </b-col>
        </b-row>
</template>

<script>
export default {
    mounted () {
        this.loadData()
    },
    data () {
        return {
            products: [],
        }
    },
    methods: {
        async loadData() {
            let {data} =  await window.axios.get('/products/all')
            this.products  = data
        },
        async addToCart (item) {
            try {
                window.location.href = '/cart/' + item
            } catch (error) {
                this.$bvToast.toast('Something went wrong', {title: 'Error', variant: 'danger', solid: true})
            }
        }
    }
}
</script>
