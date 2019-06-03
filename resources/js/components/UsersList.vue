<template>
    <div>
        <div id="modal-overlay" class="modal-overlay"  v-on:click="isActive = false | removeClass()" v-bind:class="{ active: isActive }"></div> 

        <div id="user-modal" class="user-modal" v-bind:class="{ active: isActive }" >
            <user v-bind:this-user="selUser" v-bind:this-category="category"></user>
        </div>

        <div id="user-list">
            <sidebar v-bind:this-category="category"></sidebar>
            <div id="select-category" class="bg-white p-5" v-if="category == 0">
                <div class="h3">Vælg en kategori</div>
                <div class="row">   
                    <div id="category-list" class="col-md-11 mt-3">
                        <figure class="box" v-on:click="category = categoryItem.id" v-if="categoryItem.id <= 15" v-for="categoryItem in categoriesList" v-bind:key="categoryItem.id">
                            <img :src="'/uploads/categories/cat-' + `${categoryItem.id}` + '.svg'" v-bind:alt="categoryItem.name">
                            <p class="mt-3 mb-0">{{ categoryItem.name }}</p>
                        </figure>
                    </div>
                </div>
            </div>
            <div class="col-8 m-auto pt-3" v-if="category != 0">
                <div>
                    <!--  Filters -->
                    <input type="hidden" v-model="radius" class="rad">
                    <input type="hidden" v-model="slat" class="slon">
                    <input type="hidden" v-model="slon" class="slat">
                    <input type="hidden" v-model="age" class="age">
                    <input type="hidden" v-model="category" class="category">

                    <div class="col box py-2 mb-3 d-flex jusify-content-between sort">
                        <span class="color-gray">{{ count }} Brugere</span>
                        <!-- <div class="ml-auto">
                            <input class="mr-2 form-control" v-model="search" type="text" placeholder="Search anything" />
                        </div> -->
                        <div class="input-group ml-auto"> 
                            <select v-model="currentOrder" class="custom-select" id="inputGroupSelect01">
                                <option value="name" selected>Bedst anbefaldte først</option>
                                <option value="2">Billigste først</option>
                            </select>
                        </div>
                    </div>
                    <figure v-for="user in orderedUsers" :key="user.id"  class="item box mb-3 d-flex">
                        <div class="col-9 d-flex">
                            
                            <img :src="`${user.avatar}`" alt="user">          
                            <div class="py-3 w-100">
                                <div class="d-flex justify-content-between">
                                    <h2 class="h5 mb-1">{{ user.name}} {{ user.lastname }}</h2>
                                </div>       
                                <div class="pb-0 d-flex justify-content-between">
                                    <div class="small color-gray mb-1 d-flex" v-if="findDistance(user.lat,user.lon) > 1"><div class="pin-icon"></div> {{ findDistance(user.lat,user.lon) }} km væk | {{ user.city }} | {{ user.birth }} År</div>
                                    <div class="small color-gray mb-1 d-flex" v-if="findDistance(user.lat,user.lon) < 1"><div class="pin-icon"></div> Nær dig i {{ user.city }} | {{ user.birth }} År</div>
                                    <div class="small" v-if="user_category.category_id == category" v-for="user_category in user.categories" v-bind:key="user_category.id">
                                        {{ user_category.experince }} års erfaring.
                                    </div> 
                                </div>    
                                <div class="desc-text" v-if="user_category.category_id == category" v-for="user_category in user.categories" v-bind:key="user_category.id">
                                    {{ getPostBody (user_category.description) }}                             
                                </div> 
                                <ul class="small pl-3" v-if="category == 0" >    
                                    <li v-for="u_category in user.user_categories" v-bind:key="u_category.id">
                                        {{ u_category.name }}
                                    </li>
                                </ul> 
                            </div>
                        </div>
                        <div class="col-3 py-2 bl d-flex flex-column justify-content-between">
                            <div class="d-flex align-items-center mt-4 flex-column">
                                <div v-bind:class="'rating-' + giveRating(user.id)" class="rating justify-content-center">
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                </div>
                                <a href="">{{countRating(user.id)}} Anmeldelser</a> 
                                                               
                            </div>
                            <div v-on:click="isActive = true | runner(user.id)" class="btn btn-outline-primary mb-2 profile-btn" v-bind:data-name="user.id">SE PROFIL</div> 
                        </div>
                    </figure> 
                    <figure v-if="count == 0" class=" p-3 item box mb-2">
                        <p class=" mb-0">Ingen resultater</p>
                        <p class="small mb-0 color-lgray">Prøv at ændre dine søge kriterier</p>
                    </figure>
                </div>
            </div>            
        </div>
    </div>
</template>
<script src="https://cdn.jsdelivr.net/npm/vue-resource@1.5.1"></script>

<script>
import axios from 'axios'

export default {
        props: ['mUser'],
        data () {
            return {
            users: [],
            search: '',
            isActive: false,
            slat: localStorage.latitude,
            slon: localStorage.longitude,
            currentOrder: 'name',
            radius: localStorage.radius,
            age: localStorage.age,
            km: [],
            category: 0,
            categoriesList: [],
            selUser: 0,
            
            }
        },
        mounted() {
            // Fetch initial results
            axios.get('./api/users')
                    .then(response => {
                        this.users = response.data;
            });

            axios.get('./api/categories')
                    .then(response => {
                        this.categoriesList = response.data;
            });

            axios.get('./api/opgaver')
                    .then(response => {
                        this.opgaver = response.data;
            });
            

            var that = this;
            
            $(document).ready(function () {
                $('.item.box').on("change", function() { 
                    var button = $(event.relatedTarget) // Button that triggered the modal
                    var recipient = button.data('name') // Extract info from data-* attributes
                    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                    var modal = $(this)
                    var reci = this.users;
            
                    $.getJSON( "./api/users", function( data ) {
                    $.each( data, function( key, val ) {
                            if(val.id == recipient){
                                modal.find('.modal-title').text('New message to ' + val.name)

                            }  
                        });
                    });
            
                    alert(recipient);
                })
                
                
                $("#radiusWidth").on("change", function() { 
                that.radius = $("#radiusWidth").val();
                });


                $(".item.box").on("click", function() { 
                    $('.user-modal').addClass('active');
                });

                $("#categories-list").on("change", function() { 
                that.category = $("#categories-list").val();
                });

                $("#ageWidth").on("change", function() { 
                that.age = $("#ageWidth").val();
                });
           

                 $("#location").on("keypress", function() {
                    $('.zip-codes').show();
      
                 });

                $("input.category").on("input", function() { 
                       
                  
              setTimeout(
                    function() 
                    {                
                                 var myDiv = $('.desc-text');
                    myDiv.text(myDiv.text().substring(0,100) + ' ...');
                        
                    }, 500);
                });

                 $(".zip-results").on("click", function() {
                    $('.zip-codes').hide();
                     setTimeout(
                    function() 
                    {                
                        that.slat = $("#s-lat").val();
                        that.slon = $("#s-lon").val();
                        
                    }, 500);
        

                 });
        
                    
            });

        
         
        },
        methods: {
            runner(x,y){
                this.selUser = x;
                var body = document.body;   
                body.classList.add("overflow-off");

                var overlayModal = document.getElementById("modal-overlay");
                overlayModal.classList.add("active");

                var userModal = document.getElementById("user-modal");
                userModal.classList.add("active");
            },
            removeClass(){
                var body = document.body;
                body.classList.remove("overflow-off");
                
            },
            getPostBody (desc) {
            return desc.substring(0, 160) + '...';   
            },
        // Our method to GET results from a Laravel endpoint
            countRating(uid){
                var i = 0;
                this.opgaver.forEach(opgave => {
                    
                    if (opgave.worker_id == uid) {
                       i++;
                    }
                     
                   
                });
                 return i;
            },
            giveRating(uid) {
                var i = 0;
                var summ = 0;
                this.opgaver.forEach(opgave => {
                    
                    if (opgave.worker_id == uid) {
                       i++;
                       summ = summ + opgave.rating;
                    }
                     
                   
                });
                
                return Math.round(summ / i);
                
            },
            findDistance(lat2,lon2) {
                var Rk = 6373; // mean radius of the earth (km) at 39 degrees from the equator
                // convert degrees to radians
                function deg2rad(deg) {
                    var rad = deg * Math.PI/180; // radians = degrees * pi/180
                    return rad;
                }
                
                
                // round to the nearest 1/1000
                function round(x) {
                    return Math.round( x * 1000) / 1000;
                }

                var lat1 = this.slat;
                var lon1 = this.slon;
			    var t1, n1, t2, n2, dlat, dlon,lat2, lon2, a, c, dk;
                var km = 0;
                // get values for lat1, lon1, lat2, and lon2
                t1 = lat1;
                n1 = lon1;
                t2 = lat2;
                n2 = lon2;
                
                // convert coordinates to radians
                lat1 = deg2rad(t1);
                lon1 = deg2rad(n1);
                lat2 = deg2rad(t2);
                lon2 = deg2rad(n2);
                
                // find the differences between the coordinates
                dlat = lat2 - lat1;
                dlon = lon2 - lon1;
                
                // here's the heavy lifting
                a  = Math.pow(Math.sin(dlat/2),2) + Math.cos(lat1) * Math.cos(lat2) * Math.pow(Math.sin(dlon/2),2);
                c  = 2 * Math.atan2(Math.sqrt(a),Math.sqrt(1-a)); // great circle distance in radians
                dk = c * Rk; // great circle distance in km
                
                // round the results down to the nearest 1/1000
                km = round(dk);
                km = km.toFixed(0);
                return km;
                // display the result
                
            },
       
            orderedUser(user) {
                
                var lat2 = user.lat;
                var lon2 = user.lon;
                var Rk = 6373; // mean radius of the earth (km) at 39 degrees from the equator
                // convert degrees to radians
                function deg2rad(deg) {
                    var rad = deg * Math.PI/180; // radians = degrees * pi/180
                    return rad;
                }
                
                
                // round to the nearest 1/1000
                function round(x) {
                    return Math.round( x * 1000) / 1000;
                }
                // Current users lat & lon
                var lat1 = this.slat;
                var lon1 = this.slon;

			    var t1, n1, t2, n2, dlat, dlon,lat2, lon2, a, c, dk;
                var km = 0;
                // Compare values for lat1 lon1 & lat2 lon2
                t1 = lat1;
                n1 = lon1;
                t2 = lat2;
                n2 = lon2;
                
                // convert coordinates to radians
                lat1 = deg2rad(t1);
                lon1 = deg2rad(n1);
                lat2 = deg2rad(t2);
                lon2 = deg2rad(n2);
                
                // find the differences between the coordinates
                dlat = lat2 - lat1;
                dlon = lon2 - lon1;
                
                // here's the heavy lifting
                a  = Math.pow(Math.sin(dlat/2),2) + Math.cos(lat1) * Math.cos(lat2) * Math.pow(Math.sin(dlon/2),2);
                c  = 2 * Math.atan2(Math.sqrt(a),Math.sqrt(1-a)); // great circle distance in radians
                dk = c * Rk; // great circle distance in km
                
                // round the results down to the nearest 1/1000
                km = round(dk);
    
                // display the result
               

                var sec = 0;
 
                user.categories.filter(category => {
                    
                    if (category.category_id == this.category) {
                        sec = 1;
                    }
                });
                
                if(this.category == 0) {
                    if (this.radius >= km && this.age <= user.birth && user.id != this.mUser) {
                        return user;
                    }
                }else{
                    if (this.radius >= km && this.age <= user.birth && sec == 1 && user.id != this.mUser) {
                        return user;
                    }
                }
                
                
                return false;
            }
        },
        computed: {

            orderedUsers(){
               return this.users.filter(this.orderedUser).sort((a, b) => {
                   
                        a[this.user] < b[this.user]
                        
                    }); 
     
            },

            count: function () {
                return this.users.filter(this.orderedUser).length;
            },
            
        },

    }

</script>

