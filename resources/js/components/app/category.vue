<template>
    <div>
        <b-nav  tabs>
            <b-nav-item :active="option == 1" @click="show(1)">List of Categories</b-nav-item>
            <b-nav-item :active="option == 2" @click="show(2)">Create new category</b-nav-item>
        </b-nav>
        <div v-if="option == 1">
            <b-table hover :items="items" bordered />
        </div>
        <div v-if="option == 2">
            <b-card title="New">
                <b-form>
                    <b-form-group label="Category Name">
                        <b-form-input v-model="form.name"></b-form-input>
                    </b-form-group>
                    <b-form-group>
                        <b-button @click="submit" variant="primary">Create</b-button>
                    </b-form-group>
                </b-form>
            </b-card>
        </div>
    </div>
</template>

<script>
    export default {
        async mounted () {
            try {
                await this.loadData()
            } catch (err) {
                 this.$bvToast.toast('Something went wrong', {
                        title: 'Error',
                        variant: 'danger',
                        sold: true,
                    })
            }
        },
        methods: {
            async loadData () {
                let response = await window.axios.get('/category/all')
                console.log(response)
                this.items = Object.values(response.data)
            },
            show (option) {
                if (option == 1) {
                    this.loadData()
                }
                this.option = option
            },
            async submit () {
                try {
                    await window.axios.post('/category', {name: this.form.name})
                    this.$bvToast.toast('Category Created', {title: 'Success', variant: 'success', solid: true})
                    this.form.name = ''
                } catch (err) {
                    this.$bvToast.toast('Something went wrong', {
                        title: 'Error',
                        variant: 'danger',
                        sold: true,
                    })
                }
            },
        },
        data () {
            return {
                form: {},
                option: 1,
                items: [
                    {name: 'Computer'},
                    {name: 'Mouse'}
                ]
            }
        }
    }
</script>
