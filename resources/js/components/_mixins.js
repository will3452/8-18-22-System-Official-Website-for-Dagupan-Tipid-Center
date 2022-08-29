export default {
    filters: {
        image (data) {
            if (!data) return '-'
            return '/storage/'+ data.split('/')[1]
        },
        currency (data) {
            let intl = new Intl.NumberFormat('en-IN', {style: 'currency', currency: 'PHP'})
            return intl.format(data)
        },
    },
}
