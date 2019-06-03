<template>
    <!-- Modal -->
    <div class="row" id="category-list"> 
        <div v-for="category in categoriesL" v-bind:key="category.id" class="modal fade" v-bind:id="'modal-' + category.id" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                   <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalCenterTitle">Kategori / Flytning</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="skills">Hvor mange års erfaring har du?</label>
                        <select v-bind:name="'exp-' + category.id" id="skills" class="form-control">
                            <option disabled selected>Vælg katagori</option>
                            <option value="0">Lidt erfaring</option>
                            <option value="1">1 års erfaring</option>
                            <option value="2">2 års erfaring</option>
                            <option value="3">3 års erfaring</option>
                            <option value="4">4 års erfaring</option>
                            <option value="5">5 års erfaring</option>
                            <option value="6">6 års erfaring</option>
                            <option value="7">7 års erfaring</option>
                            <option value="8">8 års erfaring</option>
                            <option value="9">9 års erfaring</option>
                            <option value="10">Mere end 10 års erfaring</option>
                            
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="desc">Beskriv dine erfaringer</label>
                        <textarea v-bind:name="'desc-' + category.id" class="form-control" id="desc" placeholder="Hvilke opgaver varetog du?" rows="3"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-primary">Luk</button>
                </div>
                </div>
            </div>
        </div>  

        <div class="col-md-4 pl-0">
            <div class="border">
                <p class="h5 px-4 bold my-3">Hus</p>
                <ul class="list-group form-group list-group-flush">
                    <li class="list-group-item" v-if="category.cat_type == 1" v-for="category in cats" v-bind:key="category.id" v-bind:id="'item-' + category.id">
                        <div class="custom-control custom-checkbox my-1 mr-sm-2">
                            <input type="checkbox" name="checked_array[]" v-bind:value="category.id" class="custom-control-input" v-bind:id="'check-' + category.id">
                            <label class="custom-control-label"  v-bind:for="'check-' + category.id">{{ category.name }}</label>   
                        </div>  
                        <button type="button" class="list-btn" data-toggle="modal" v-bind:data-name="category.name" v-bind:data-target="'#modal-' + category.id">Tilføj beskrivelse</button>
                    </li>
                </ul>
            </div>
        </div>
       <div class="col-md-4">
            <div class="border">
                <p class="h5 px-4 bold my-3">Have</p>
                <ul class="list-group form-group list-group-flush">
                   <li class="list-group-item" v-if="category.cat_type == 2" v-for="category in cats" v-bind:key="category.id" v-bind:id="'item-' + category.id">
                        <div class="custom-control custom-checkbox my-1 mr-sm-2">
                            <input type="checkbox" name="checked_array[]" v-bind:value="category.id" class="custom-control-input" v-bind:id="'check-' + category.id">
                            <label class="custom-control-label" v-bind:for="'check-' + category.id">{{ category.name }}</label>
                        </div>
                        <button type="button" class="list-btn" data-toggle="modal" v-bind:data-name="category.name" v-bind:data-target="'#modal-' + category.id">Tilføj beskrivelse</button>
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-md-4 pr-0">
            <div class="border">
                <p class="h5 px-4 bold my-3">Diverse</p>
                <ul class="list-group form-group list-group-flush">  
                    <li class="list-group-item" v-if="category.cat_type == 3" v-for="category in cats" v-bind:key="category.id" v-bind:id="'item-' + category.id">
                        <div class="custom-control custom-checkbox my-1 mr-sm-2">
                            <input type="checkbox" name="checked_array[]" v-bind:value="category.id" class="custom-control-input" v-bind:id="'check-' + category.id">
                            <label class="custom-control-label" v-bind:for="'check-' + category.id">{{ category.name }}</label>
                        </div>  
                        <button type="button" class="list-btn" data-toggle="modal" v-bind:data-name="category.name" v-bind:data-target="'#modal-' + category.id">Tilføj beskrivelse</button>
                    </li>
                </ul>
            </div>
        </div>
    </div>


</template>


<script>
import axios from 'axios'
export default {
        name: "categories-list",
        props: ['postTitle'],
        data() {
            return {      
              categoriesL: [],
              users: [],
              counter: 0
              
            }
        },
        methods: {
            checker(id){
                return this.users.filter(this.user).length;
            }
            
        },
        mounted() {
            

             axios.get('./api/users')
                    .then(response => {
                        this.users = response.data;
            });
            axios.get('./api/categories')
                    .then(response => {
                        this.categoriesL = response.data;
            });
            var user_id_na = this.postTitle;
            var usdr = Number(user_id_na);
            usdr = usdr - 1;

            $(document).ready(function () {
                
                $.getJSON( "./api/users", function( data ) {
                    $.each( data[usdr].categories, function( key, val ) {
                        $('#check-' + val.category_id).prop('checked', true);
                        $('#modal-' + val.category_id + ' #skills').val(val.experince);
                        $('#modal-' + val.category_id + ' textarea').val(val.description); 
                    
                    });
                });
 
                
                $.getJSON( "./api/categories", function( data ) {
                    $.each( data, function( key, val ) {

                        

                        $('#check-' + val.id).on('change', function() {
                            if(this.checked) {
                                $('#item-' + val.id + ' button').show();
                            }else{
                                $('#item-' + val.id + ' button').hide();
                            }
                        });
                        
                        var modalName = $('#item-' + val.id + ' button').data('name');  
                        $('#modal-' + val.id + ' .modal-title').text('Kategori / ' + modalName);    
                    
                        // place this within dom ready function
                        function showpanel() {     
                            if ($('#check-' + val.id).prop('checked') == true) {
                                $('#item-' + val.id + ' button').show();
                                
                            }
                        
                            
                        }
                        // use setTimeout() to execute
                        setTimeout(showpanel, 1000);
                
                        
                         
                        

                    });
                    
                });

                

       
            });
  
        },
        computed: {
            cats() {
                return this.categoriesL;
            },
            vuser(){
                var text = this.postTitle;
                var integer = Number(text);
                integer = integer - 1;
                return this.users[integer];                
            },
        }   
    }

</script>

