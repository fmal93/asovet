<template>
    <div class="patitas">
        <div class="card my-4 p-3 shadow border-0" style="background: none;">
            <div class="card-body">
                <h5 class="text-muted text-center">REVISA NUESTROS PRODUCTOS!</h5>
            </div>
        </div>
        <h3 class="text-center" style="color: darkcyan;">Asovet SPA</h3>
        <div class="container pt-4">
            <div class="row pl-3 pr-3">
                <div class="col-sm-3 pb-3"  v-for="product in products" v-bind:key="product.id">
                    <div class="card border-0">
                        <div class="card-body">
                            <a v-bind:href="'/product/'+ product.id"><img class="card-img-top" v-bind:src="'/images/'+ product.slug +'.jpg'"></a>
                            <a v-bind:href="'/product/'+ product.id" class="nav-link"><p class="card-text font-weight-bold text-center" 
                            style="text-decoration: none; color: black; font-size: 22px;">{{ product.name }}</p></a>
                            <p class="text-muted text-center">{{ product.details }}</p>
                            <p class="text-center font-weight-bold shadow-sm" style="font-size:22px;">&#36;{{ product.price }}</p>
                            <div class="text-center"><a v-bind:href="'/product/'+ product.id" class="btn btn-success">Ver Detalles</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        
        data(){
            return {
                products: [],
                product: {
                    id: '',
                    name: '',
                    slug: '',
                    details: '',
                    price: '',
                    description: ''                    
                },
                product_id: '',
                pagination: {}
            }
        },
        created(){
            this.fetchproducts();
        },
        methods: {
            fetchproducts() {
                fetch('api/products').then(res => res.json()).then(res => {this.products = res.data;})
            }
        },
        mounted() {

        }
    }    
</script>

<style scoped>
    .patitas {
        background-image: url('/images/patitas.jpeg');
    }
</style>