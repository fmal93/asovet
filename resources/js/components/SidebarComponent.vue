<template>
    <div class="col-md-3 pt-5" style="background: none;">
        <div>
            <h5 class="p-3 border rounded" id="sidebarElement">
                Categorias
                <svg width="1.3em" height="1.3em" viewBox="0 0 16 16" class="bi bi-arrow-down-short float-right" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M4.646 7.646a.5.5 0 0 1 .708 0L8 10.293l2.646-2.647a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 0 1 0-.708z"/>
                    <path fill-rule="evenodd" d="M8 4.5a.5.5 0 0 1 .5.5v5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5z"/>
                </svg>
            </h5>
            <div id="sidebarBody">
                <ul>
                    <li>
                        <input type="checkbox" id="perros">
                        <label for="perros">
                            <span>Perros</span>
                        </label>

                    </li>
                    <li>               
                        <input type="checkbox" id="gatos">
                        <label for="gatos">
                            <span>Gatos</span>
                        </label>                                             
                    </li>
                    <li>                       
                        <input type="checkbox" id="otros">
                        <label for="otros">
                            <span>Otros</span>
                        </label>                  
                    </li>
                </ul>
            </div>
        </div>
        <div>
            <h5 class="p-3 border rounded" id="sidebarElement2">
                Marcas
                <svg width="1.3em" height="1.3em" viewBox="0 0 16 16" class="bi bi-arrow-down-short float-right" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M4.646 7.646a.5.5 0 0 1 .708 0L8 10.293l2.646-2.647a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 0 1 0-.708z"/>
                    <path fill-rule="evenodd" d="M8 4.5a.5.5 0 0 1 .5.5v5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5z"/>
                </svg>
            </h5>
            <div id="sidebarBody2">
                <ul>
                    <li>                      
                        <input type="checkbox" id="fit-formula">
                        <label for="fit-formula">
                            <span>Fit Formula</span>
                        </label>                                        
                    </li>
                    <li>                      
                        <input type="checkbox" id="pro-plan">
                        <label for="pro-plan">
                            <span>Pro Plan</span>
                        </label>                                              
                    </li>
                    <li>
                        <input type="checkbox" id="dog-chow">
                        <label for="dog-chow">
                            <span>Dog Chow</span>
                        </label>
                    </li>
                </ul>
            </div>
        </div>
        <div>
            <h5 class="p-3 border rounded" id="sidebarElement3">
                Sub-Categorias
                <svg width="1.3em" height="1.3em" viewBox="0 0 16 16" class="bi bi-arrow-down-short float-right" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                    <path fill-rule="evenodd" d="M4.646 7.646a.5.5 0 0 1 .708 0L8 10.293l2.646-2.647a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 0 1 0-.708z"/>
                    <path fill-rule="evenodd" d="M8 4.5a.5.5 0 0 1 .5.5v5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5z"/>
                </svg>
            </h5>
            <div id="sidebarBody3">
                <ul>
                    <li>
                        <input type="checkbox" id="acessorios">
                        <label for="acessorios">
                            <span>Acessorios</span>
                        </label>
                    </li>
                    <li>
                        <input type="checkbox" id="alimento">
                        <label for="alimento">
                            <span>Alimentos</span>
                        </label>                        
                    </li>
                    <li>                        
                        <input type="checkbox" id="medicinas">
                        <label for="medicinas">
                            <span>Medicinas</span>
                        </label>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
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
</style>