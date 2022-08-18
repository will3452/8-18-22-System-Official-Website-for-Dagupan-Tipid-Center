<template>
    <div>
        <b-navbar toggleable="lg" class="px-1" type="light" variant="white" >
            <b-navbar-brand>
                <img width="50" src="https://thumbs.dreamstime.com/b/demo-demo-icon-139882881.jpg" alt="">
            </b-navbar-brand>
            <b-navbar-nav :small="true" :fill="true">
                <b-nav-item :href="link" :key="label" v-for="{link, label, icon} in categories">
                    <b-icon v-if="icon" :icon="icon"></b-icon>
                    {{label}}
                </b-nav-item>
            </b-navbar-nav>
        </b-navbar>
    </div>
</template>

<script>
export default {
    props: ['categories']
}
</script>
