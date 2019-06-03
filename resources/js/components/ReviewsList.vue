<template>
    <div> 
        <div class="reviews">

            <div v-for="opgave in opgaver" v-if="opgave.worker_id == thisUser" :key="opgave.id" class="review p-4 border-bottom-d">
                <div class="d-flex">
                    <img class="mr-3" v-for="user in users" v-if="opgave.user_id == user.id" :key="user.id"  v-bind:src="user.avatar" alt="">
                    <div class="d-flex flex-column w-100">
                        <div class="d-flex justify-content-between">
                            <p v-for="user in users" v-if="opgave.user_id == user.id" :key="user.id"  class="mb-0 bold">{{ user.name + ' ' + user.lastname }} | <span v-for="category in categories" v-if="opgave.category_id == category.id" :key="category.id" class="color-pink">
                                {{ category.name }}
                                </span> | Odense M</p>
                            <p class="date mb-0">20 juli 2018</p>
                        </div>
                        <div v-bind:class="'rating-' + opgave.rating"  class="rating rating justify-content-start mt-2">
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                            <div></div>
                        </div>
                    </div>
                </div>
                <div class="mt-2">
                    <p class="mb-0">{{ opgave.rating_comment }}</p>
                </div>
            </div>

        </div>   
    </div>                       
</template>

<script>
import axios from 'axios'

export default {
        props: ['thisUser','thisCategory'],
        data () {
            return {
            users: [],
            opgaver: [],
            categoryList: [],
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
                    this.categories = response.data;
            });

            axios.get('./api/opgaver')
                    .then(response => {
                        this.opgaver = response.data;
            });

            var that = this;
            $(document).ready(function () {
            
        

            //that.isActive.evex
                    
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
                    summ = summ / i; 
                    return summ.toFixed(1);
                }
                
            }
            
        },
        computed: {

           
            

            
        },
        watch: {

        }

    }

</script>

