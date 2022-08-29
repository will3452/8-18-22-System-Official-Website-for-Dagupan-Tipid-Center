<template>
    <div>
        <b-nav  tabs>
            <b-nav-item :active="option == 1" @click="show(1)">List of Categories</b-nav-item>
            <b-nav-item :active="option == 2" @click="show(2)">Create new category</b-nav-item>
        </b-nav>
        <div v-if="option == 1">
            <table class="table table-sm table-bordered" id="table">
                <thead>
                    <tr>
                        <th>
                            Name
                        </th>
                        <th>
                            Action
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item in items" :key="item.id">
                        <td>
                            {{item.name}}
                        </td>
                        <td>
                            <b-button size="sm" variant="danger" @click="deleteItem(item.id)"><b-icon-trash></b-icon-trash> remove</b-button>
                        </td>
                    </tr>
                </tbody>
            </table>
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
            async deleteItem (id) {
                try {
                    await window.axios.delete('/category/' + id)
                    this.$bvToast.toast('Record deleted', {title:'Success', variant: 'success', solid: true})
                } catch (err) {
                    this.$bvToast.toast('Error', {title: 'Error', variant: 'danger', solid: true })
                    console.log('Error', err)
                } finally {
                    this.loadData()
                }
            },
            async loadData () {
                let response = await window.axios.get('/category/all')
                console.log(response)
                this.items = Object.values(response.data).map( e =>  {
                    e.action = ''
                    return e
                })
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
