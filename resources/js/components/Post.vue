<template>

   

</template>


<script>
import axios from 'axios'
export default {
        data () {
            return {
            posts: []
            }
        },
        created() {


            axios.get("http://tak-for-hjalpen:8888/api/opgaver").then(response => (this.post = response.data))
            
      
            
        },      
    }

</script>

