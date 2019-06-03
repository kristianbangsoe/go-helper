<template>
    <div> 
        <div class="scroll-y" v-for="user in users" v-if="user.id == thisUser" :key="user.id">
            <div id="user-body" >

                <div class="d-flex flex-row p-5">
                    <button type="button" class="close-2 c-modal" v-on:click="isActive = false | removeClass()" aria-label="Close"></button>  
                    <img class="avatar" :src="`${user.avatar}`" alt="user">
                    <div class="ml-3 d-flex w-100 flex-column justify-content-between">
                        <div class="d-flex flex-row justify-content-between">
                            <div>
                                <h3>{{user.name}} {{user.lastname}}</h3>
                                <p class="mb-0">Bor i {{user.city}} – {{user.zip}}</p>
                                <div class="d-flex bold mb-0" v-if="user_category.category_id == thisCategory" v-for="user_category in user.categories" v-bind:key="user_category.id">
                                    {{ user_category.experince }} års erfaring inden for <div class="ml-1 color-pink" v-for="cat in categoryList" v-bind:key="cat.id" v-if="cat.id == thisCategory"> {{ cat.name }} </div>
                                </div> 
                                <p class="bold mb-0">Alder: {{user.birth}} år</p>
                            </div>
                            
                            <div class="d-flex align-items-end flex-column">
                                <div class="d-flex">
                                    <p class="h3 mr-2 mb-0">{{ giveRating(user.id, 0) }}</p>
                                    <div v-bind:class="'rating-' + giveRating(user.id, 1)" class="rating-lg rating justify-content-end">
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                </div> 
                                </div>
                                <a href="">{{ countRating(user.id) }} Anmeldelser</a> 
                            </div>
                            
                        </div>
                        <div class="d-flex justify-content-end">
                            <basic-vue-chat :new-message="message" />
                            <button class="btn btn-primary mr-3">Send besked</button>
                            <button class="btn bg-pink">Tilbyd job</button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="p-5">
                <div class="d-flex">
                    <button v-on:click="activetab=1" class="tab-btn btn btn-lg" v-bind:class="[ activetab === 1 ? 'active' : '' ]" >Erfaring</button>
                    <button v-on:click="activetab=2" class="tab-btn btn btn-lg ml-3" v-bind:class="[ activetab === 2 ? 'active' : '' ]" >Om mig</button>
                </div>
                <div class="bg-white tab-els p-4" >
                    <div class="tab" v-if="activetab === 1">
                        <div class="d-flex mb-0" v-for="category in user.categories" v-if="category.category_id == thisCategory" v-bind:key="category.id">
                        {{ category.description }}
                        </div> 
                    </div>
                    
                    <div class="tab"  v-if="activetab === 2">
                        <div class="d-flex mb-0">
                            {{ user.bio }}
                        </div> 
                    </div>
                    
                </div>
                <div class="bg-white mt-3">
                    <div class="p-4 border-bottom d-flex justify-content-between align-items-center">
                        <p class="h4 bold mb-0">Mine Anbefalinger</p>
                        <div class="d-flex align-items-end flex-column">
                            <div class="d-flex">
                                <p class="h3 mr-2 mb-0" >{{ giveRating(user.id, 0) }}</p>
                                <div v-bind:class="'rating-' + giveRating(user.id, 1)" class="rating-lg rating justify-content-end">
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                    <div></div>
                                </div>
                            </div>
                            <a href="">{{ countRating(user.id) }} Anmeldelser</a> 
                        </div>
                    </div>
                    <reviews-list  v-bind:this-user="thisUser" v-bind:this-category="thisCategory"></reviews-list>
                </div>
            </div>  
        </div>       
    </div>                       
</template>
<script src="https://cdn.jsdelivr.net/npm/vue-resource@1.5.1"></script>

<script>
import axios from 'axios'

export default {
        props: ['thisUser','thisCategory'],
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
            activetab: 1
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
                    this.categoryList = response.data;
            });

            axios.get('./api/opgaver')
                    .then(response => {
                        this.opgaver = response.data;
            });

            var that = this;
            $(document).ready(function () {
            
        

            // that.isActive.evex
                    
            });

        
         
        },
        methods: {
            countRating(uid){
                var i = 0;
                this.opgaver.forEach(opgave => {
                    
                    if (opgave.worker_id == uid) {
                       i++;
                    }
                    
                   
                });
                 return i;
            },
            giveRating(uid, mod) {
                var i = 0;
                var summ = 0;
                
                this.opgaver.forEach(opgave => {
                    
                    if (opgave.worker_id == uid) {
                       i++;
                       summ = summ + opgave.rating;
                    }
                     
                   
                });
                
                if(mod == 1){
                    return Math.round(summ / i);
                }else{
                    if (summ != 0) {
                        summ = summ / i; 
                        return summ.toFixed(1);
                    }else{
                        
                        return '0.0';
                    }
                    
                }
                
            },
            removeClass(){
                var body = document.body;   
                body.classList.remove("overflow-off");

                var overlayModal = document.getElementById("modal-overlay");
                overlayModal.classList.remove("active");

                var userModal = document.getElementById("user-modal");
                userModal.classList.remove("active");
            }
        },
        computed: {

            
         
            
        },
        watch: {

        }

    }

</script>

