<template>
    <div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="c_region">Region</label>
                <select id="inputState" name="c_region" class="form-control" required v-model="selected">
                    <option selected disabled>Selecciona tu Region</option>
                <option v-for="region in regions" v-bind:key="region.id" v-bind:value="region.id">{{ region.name }}</option>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="c_comuna">Comuna</label>
                <select id="inputState" name="c_comuna" class="form-control" required v-model="comunaSelected">
                <option selected disabled>Selecciona tu Comuna</option>
                <option v-for="comuna in comunas" v-bind:key="comuna.id" v-bind:value="comuna.id">{{ comuna.name }}</option>
                </select>
            </div>
        </div>
        <div class="row my-3">
            <div class="col-md-12 d-flex justify-content-around">
                <div class="col-md-4 text-center">
                    <p class="text-muted border-bottom">Total Productos</p>
                    <p><strong class="text-dark">CLP {{ total }} </strong></p>
                </div>
                <div class="col-md-4 text-center">
                    <p class="text-muted border-bottom">Costo del envio</p>
                    <p><strong class="text-dark">CLP {{ envio.toFixed() }} </strong></p>
                </div>
                <div class="col-md-4 text-center">
                    <p class="text-muted border-bottom">Total neto a pagar</p>
                    <p><strong class="text-dark">CLP {{ Number(total) + Number(envio) }} </strong></p>
                </div>
            </div>
        </div>
        <input type="hidden" name="c_amount" v-bind:value="Number(total) + Number(envio)">
    </div>                        
</template>

<script>
    export default {
        data() {
            return {
                regions: [],
                comunas: [],
                envio: 0,
                selected: '',
                comunaSelected: '',
            }
        },
        props: ['total'],
        methods: {
            loadRegiones: function() {
                axios.get('/api/regiones').then((response) => {
                    this.comunas = '';
                    this.regions = response.data.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            loadComunas(id) {
                axios.get('/api/comunas/'+ id).then((response) => {
                    this.comunas = response.data.data;
                })
                .catch(function (error) {
                    console.log(error);
                });
            },
            actualizarEnvio(id) {
                this.envio = 0;
                if (id == 7) {
                    if(this.comunaSelected == 46 && this.total > 10000){
                        this.envio = 0;
                        console.log('pudahuel')
                    }else{
                        this.envio = 3000;
                    }     
                    if(this.comunaSelected == 32 || this.comunaSelected == 13 || this.comunaSelected == 27 || this.comunaSelected == 47 || this.comunaSelected == 367 || this.comunaSelected == 53 || this.comunaSelected == 18 || this.comunaSelected == 41 || this.comunaSelected == 368 || this.comunaSelected == 369){
                        this.envio = 4500;
                    }       
                }
            }
        },
        mounted() {
            this.loadRegiones();
        },
        watch: {
            selected: {
                handler: function () {
                    this.loadComunas(this.selected);
                },
                deep: true
            },
            comunaSelected: {
                handler: function () {
                    this.actualizarEnvio(this.selected);
                }
            }
        }
    }
    
</script>

<style scoped>

</style>