<template>
    <div>
        <b-modal id="new-product" title="Product" @cancel="resetProduct" @ok="createProduct">
            <b-form-group label="Name">
                <b-form-input v-model="product.name"></b-form-input>
            </b-form-group>
            <b-form-group label="Description">
                <b-form-textarea v-model="product.description"></b-form-textarea>
            </b-form-group>
            <b-form-group label="Price">
                <b-form-input type="number" v-model="product.price"></b-form-input>
            </b-form-group>
            <b-form-group label="Quantity">
                <b-form-input type="number" v-model="product.quantity"></b-form-input>
            </b-form-group>
            <b-form-group label="Image">
                <b-form-file v-model="product.image" @input="uploadImage"></b-form-file>
            </b-form-group>
        </b-modal>
        <b-modal id="view-product" title="Product Details" :hide-footer="true" @close="resetProduct" >

             <b-row class="justify-content-center">
                <b-col cols="6">
                    <b-img fluid-grow :src="product.image | image" alt=""/>
                </b-col>
             </b-row>
            <table class="table table-sm table-bordered">
                <tr>
                    <th>
                        Name
                    </th>
                    <td>
                        {{product.name}}
                    </td>
                </tr>
                <tr>
                    <th>
                        Description
                    </th>
                    <td>
                    {{product.description}}
                    </td>
                </tr>
                <tr>
                    <th>
                        Price
                    </th>
                    <td>
                        {{product.price | currency}}
                    </td>
                </tr>
                <tr>
                    <th>
                        Quantity
                    </th>
                    <td>
                        {{product.quantity}}
                    </td>
                </tr>
                <tr>
                    <th>
                        Status
                    </th>
                    <td>
                        {{product.status}}
                    </td>
                </tr>
            </table>
        </b-modal>
            <b-row class="mb-2 d-flex justify-content-between mt-4">
                <b-col cols="4" class="d-flex">
                    <b-input placeholder="Search Product Name" v-model="search" :autocomplete="false" :autofill="false" :aria-autocomplete="false"></b-input>
                </b-col>
                <b-col cols="4" class="text-right">
                    <b-button variant="success" v-b-modal.new-product>
                        <b-icon-plus></b-icon-plus>
                        New Product
                    </b-button>
                </b-col>
            </b-row>
            <table class="table table-sm table-bordered">
                <thead>
                    <tr>
                        <th>
                            Name
                        </th>
                        <th>
                            Description
                        </th>
                        <th>
                            Price
                        </th>
                        <th>
                            Quantity
                        </th>
                        <th>
                            Status
                        </th>
                        <th>
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in dataTables" :key="item.id">
                        <td>
                            {{item.name}}
                            <img :src="item.image | image" width="25" alt="" class="mx-4 rounded border">
                        </td>
                        <td>
                            {{item.description}}
                        </td>
                        <td>
                            {{item.price | currency}}
                        </td>
                        <td>
                            {{item.quantity}}
                        </td>
                        <td>
                            {{item.status}}
                        </td>
                        <td>
                            <b-button variant="info" size="sm" @click="viewProduct(item)" v-b-modal.view-product><b-icon-eye></b-icon-eye> show</b-button>
                            <b-button v-b-modal.new-product @click="editProduct(item)" variant="secondary" size="sm"> <b-icon-pen></b-icon-pen> edit</b-button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="text-secondary" v-if="! dataTables.length">No record found.</div>
    </div>
</template>
<script>
export default {
    async mounted () {
        await this.loadData()
    },
    data () {
        return {
            product: {},
            editMode: false,
            products: [],
            search: '',
        }
    },
    methods: {
        viewProduct(item) {
            this.product = item
        },
        editProduct(item) {
            this.product = item
            this.editMode = true
        },
        async uploadImage() {
            try {
                let fd = new FormData()
                fd.append('image', this.product.image)
                let {data} = await window.axios.post('/image-upload', fd)
                this.product.imagePath = data;
            } catch (err) {
                console.log(err)
                this.$bvToast.toast('Error to upload', {title: 'Error', variant: 'Error', solid: true})
            }
        },
        resetProduct () {
            this.product = {}
            this.loadData()
        },
        async loadData () {
            let {data}  = await window.axios.get('/products/all')
            this.products = data
        },
        async createProduct () {
            try {
                if (! this.product.name) throw new Error('Product Name is required.')
                if( ! this.product.price) throw new Error('Product Price is required.')
                if (! this.product.description) throw new Error('Product Description is required.')
                if (! this.product.quantity) throw new Error('Product Quantity is required.')
                if (this.product.image) {
                    this.product.image = this.product.imagePath
                }
                if (! this.editMode) {
                    await window.axios.post('/products/', this.product)
                    this.$bvToast.toast('Product has been added!', {title: 'Success', variant: 'success', solid: true})
                } else {
                    await window.axios.put('/products/' + this.product.id, this.product)
                    this.$bvToast.toast('Product has been updated!', {title: 'Success', variant: 'success', solid: true})
                }
            } catch (err) {
                this.$bvToast.toast(err.message || 'Creation of product error', {title: 'Error', variant: 'danger', solid: true})
            } finally {
                if (this.editMode) {
                    this.editMode = false
                }
                this.loadData()
                this.product = {}
            }
        }
    },
    computed: {
        dataTables () {
            return this.products.filter( e => e.name.includes(this.search))
        }
    }
}
</script>
