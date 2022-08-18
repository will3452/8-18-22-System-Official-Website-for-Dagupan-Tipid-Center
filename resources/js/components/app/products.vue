<template>
    <b-row center>
            <b-col :sm="6" :xs="12" :md="3" v-for="i in 5" :key="i" class="mt-4">
                <b-card :img-src="`https://picsum.photos/600/600/?image=${25+i}`">
                    <b-card-text class="text-center">
                        <div class="text-lg">Product Name</div>
                       <div class="font-bold p-2 rounded text-warning" style="font-weight:900">200.00 php</div>
                        <b-button variant="success" size="sm">
                            <b-icon-plus></b-icon-plus>
                            Add to cart
                            </b-button>
                    </b-card-text>
                </b-card>
            </b-col>
        </b-row>
</template>
