<template>

   <div>
        <div class="col box py-2 mb-3">
            <span class="color-gray">{{ count }} Resultater</span>
            <div class="mr-auto">
                
            </div>
        </div>
        <input v-model="search" type="text" placeholder="Search anything" />
        
        <figure v-for="post in orderedPosts" :key="post.id" class="item box mb-2 d-flex">
            

            <div class="col-8 py-3">
                <h2 class="h5">{{ post.title }}</h2>               
                <div class="d-flex">
                    <img :src="`${post.avatar}`" alt="">      
                    <p>Af {{ post.name }} | {{ post.date }}</p>       
                    <p></p>       
                </div>
                <div>{{ post.body }}</div>
            </div>
            <div class="col-4 py-2 bl">
            <!-- <router-link :to="{ name: 'post', params: { id: post.id }}">

                hello
            </router-link>-->

            </div>
        </figure>
        
           
   </div>
                

</template>
<script src="https://cdn.jsdelivr.net/npm/vue-resource@1.5.1"></script>

<script>
import axios from 'axios'
export default {
        data () {
            return {
            posts: [],
            search: '',
            name: '',
            }
        },
        mounted() {
            // Fetch initial results
            axios.get('./api/opgaver')
                    .then(response => {
                        this.posts = response.data;
                    });
            

        },
        methods: {
        // Our method to GET results from a Laravel endpoint
   
        },
        computed: {
            orderedPosts() {
                if (this.search.length > 3){
                return this.posts.filter(post => {
                    return post.title.toLowerCase().includes(this.search.toLowerCase())
                })
                }else{
                    
                    return this.posts;
                   
                }
     
            },
            count: function () {
            return this.posts.length;
            }
            
        }
    }

</script>

