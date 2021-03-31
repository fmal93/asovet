<template>
    <div class="row">
        <div class="col-md-3 pt-5" style="background: none;">
            <h5 class="p-3 border rounded" id="sidebarElement">
                Categorias
                <svg width="1.3em" height="1.3em" viewBox="0 0 16 16" class="bi bi-arrow-down-short float-right" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M4.646 7.646a.5.5 0 0 1 .708 0L8 10.293l2.646-2.647a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 0 1 0-.708z"/>
                    <path fill-rule="evenodd" d="M8 4.5a.5.5 0 0 1 .5.5v5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5z"/>
                </svg>
            </h5>
            <div id="sidebarBody">
                <ul>
                    <li v-for="(category, index) in categories" v-bind:key="category.id">
                        <input type="checkbox" :value="category.id" :id="'category'+index" v-model="selected.categories">
                        <label :for="'category'+index">
                            <span>{{ category.name }} ({{ category.products_count }})</span>
                        </label>
                    </li>
                </ul>
            </div>
            <h5 class="p-3 border rounded" id="sidebarElement2">
                Marcas
                <svg width="1.3em" height="1.3em" viewBox="0 0 16 16" class="bi bi-arrow-down-short float-right" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M4.646 7.646a.5.5 0 0 1 .708 0L8 10.293l2.646-2.647a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 0 1 0-.708z"/>
                    <path fill-rule="evenodd" d="M8 4.5a.5.5 0 0 1 .5.5v5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5z"/>
                </svg>
            </h5>
            <div id="sidebarBody2">
                <ul>
                    <li v-for="(brand, index) in brands" v-bind:key="brand.id">
                        <input type="checkbox" :value="brand.id" :id="'brand-'+ index" v-model="selected.brands">
                        <label :for="'brand-'+ index">
                            <span>{{ brand.name }} ({{ brand.products_count }})</span>
                        </label>
                    </li>
                </ul>
            </div>
            <h5 class="p-3 border rounded" id="sidebarElement3">
                Sub-Categorias
                <svg width="1.3em" height="1.3em" viewBox="0 0 16 16" class="bi bi-arrow-down-short float-right" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M4.646 7.646a.5.5 0 0 1 .708 0L8 10.293l2.646-2.647a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 0 1 0-.708z"/>
                    <path fill-rule="evenodd" d="M8 4.5a.5.5 0 0 1 .5.5v5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5z"/>
                </svg>
            </h5>
            <div id="sidebarBody3">
                <ul>
                    <li v-for="(type, index) in types" v-bind:key="type.id">
                        <input type="checkbox" :value="type.id" :id="'type'+index" v-model="selected.types">
                        <label :for="'type'+index">
                            <span>{{ type.name }} ({{ type.products_count }})</span>
                        </label>
                    </li>
                </ul>
            </div>       
        </div>
        <div class="col-md-9">
            <div class="card my-4 py-3 shadow border-0" style="background: none;">
                <div class="card-body">
                    <h5 class="text-muted text-center">REVISA NUESTROS PRODUCTOS!</h5>
                </div>
            </div>
            <div class="container pt-4">
                <div v-if="loading == true" class="w-100  d-flex justify-content-center">
                    <div class="spinner-border" role="status">
                        <span class="sr-only">Loading...</span>
                    </div>
                </div>
                <div v-else></div>
                <div class="row pl-3 pr-3">
                    <div class="col-sm-4 pb-3"  v-for="product in products" v-bind:key="product.id">
                        <div class="card border-0">
                            <div class="card-body">
                                <a v-bind:href="'/tienda/'+ product.id"><img class="card-img-top" v-bind:src="'/storage/product_images/'+ product.slug +'.jpg'"></a>
                                <a v-bind:href="'/tienda/'+ product.id" class="nav-link"><p class="card-text font-weight-bold text-center" 
                                style="text-decoration: none; color: black; font-size: 18px;">{{ product.name }}</p></a>
                                <p class="text-muted text-center" style="font-size: 12px;">{{ product.details }}</p>
                                <p class="text-center font-weight-bold shadow-sm" style="font-size:22px;">&#36;{{ product.price }}</p>
                                <div class="text-center w-100 d-flex">
                                    <a v-bind:href="'/tienda/'+ product.id" class="btn btn-success w-50 m-1 btn-sm">Detalles</a>
                                    <a v-if="product.stock > 0" v-bind:href="'/add-to-cart/'+ product.id" class="btn btn-success w-50 m-1 btn-sm" style="font-size: 13px; padding-left: 0; padding-right: 0;"> Añadir carrito</a>
                                    <p v-else class="text-muted m-2">Agotado</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                    <li v-bind:class="[{disabled: !links.prev}]" class="page-item">
                        <a class="page-link" href="" @click.prevent="loadPagination(links.prev), scrollToTop()">previous</a>
                    </li>
                    <li class="page-item" v-for="n in pagination.last_page" v-bind:key="n">
                        <a v-show=" n != pagination.current_page" class="page-link" href="" @click.prevent="loadPagination('/api/products?page=' + n +''), scrollToTop()">{{n}}</a>
                    </li>
                    <li v-bind:class="[{disabled: !links.next}]" class="page-item">
                        <a class="page-link" href="" @click.prevent="loadPagination(links.next), scrollToTop()" >Next</a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
        
</template>
<script>
    export default {
        
        data(){
            return {
                loading: true,
                categories: [],
                brands: [],
                types: [],
                products: [],
                selected: {
                    categories: [],
                    types: [],
                    brands: []                    
                },
                product_id: '',
                pagination: {},
                links: {}
            }
        },
        methods: {
            loadCategories: function () {
                axios.get('/api/categories', {
                    params: _.omit(this.selected, 'categories')
                })
                .then((response) => {
                    this.categories = response.data.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            loadProducts: function () {
                axios.get('/api/products', {
                    params: this.selected
                })
                .then((response) => {
                    this.products = response.data.data;
                    this.pagination = response.data.meta;
                    this.links = response.data.links;
                    this.loading = false;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            loadBrands: function () {
                axios.get('/api/Brands', {
                    params: _.omit(this.selected, 'brands')
                })
                .then((response) => {
                    this.brands = response.data.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            loadTypes: function () {
                axios.get('/api/types', {
                    params: _.omit(this.selected, 'types')
                })
                .then((response) => {
                    this.types = response.data.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            loadPagination(link){
                axios.get(link, {
                    params: this.selected
                })
                .then((response) => {
                    this.products = response.data.data;
                    this.pagination = response.data.meta;
                    this.links = response.data.links;
                    this.loading = false;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            scrollToTop() {
                window.scrollTo(0,0);
            }
        },
        mounted() {
            this.loadCategories();
            this.loadBrands();
            this.loadTypes();
            this.loadProducts();
            $( document ).ready(function() {
                $("#sidebarElement").click(function(){
                    $("#sidebarBody").toggle();
                });
                 $("#sidebarElement2").click(function(){
                    $("#sidebarBody2").toggle();
                });
                 $("#sidebarElement3").click(function(){
                    $("#sidebarBody3").toggle();
                });
            });
        },
        watch: {
            selected: {
                handler: function () {
                    this.loadCategories();
                    this.loadBrands();
                    this.loadTypes();
                    this.loadProducts();
                },
                deep: true
            }
        }
    }    
</script>

<style scoped>
    h5 {
       cursor: pointer;
       letter-spacing: 2px;
   }
   h5:hover {
       background: #f1f1f1;
   }
   div ul {
       margin-left: 0;
       padding-left: 20px;
   }
   div ul li {
       list-style: none;
   }
   div ul li a {
       text-decoration: none;
   }
    div ul li span {
        color: black;
        font-weight: 500;
        font-size: 16px;
        cursor: pointer;
        letter-spacing: 2px;
        position: relative;
        bottom: 2px;
        padding-left: 4px;
    }
    div ul li span:hover {
        color: green;
    }
    div ul li a input {
        width: 16px;
        height: 16px;
        cursor: pointer;
    }
    @media (max-width: 600px) {
        #sidebarBody {
            display: none;
        }
        #sidebarBody2 {
            display: none;
        }
        #sidebarBody3 {
            display: none;
        }
    }
    .pagination {
        display: flex;
        flex-wrap: wrap;
    }
</style>