<template>
    <aside class="sidebar bg-white navbar-laravel" v-bind:class="{ active: !showBtn }">
        <div class="px-4">
            <div>
                <div class="col">
                    <p class="h5 mb-3">Søg blandt hjælpere</p>
         
                    <form action="">
                        <!-- Location -->
                        <div class="form-group location selector">
                            <label for="location">Dit postnummer</label>
                            
                            <input v-model="location"  autocomplete="off" type="text" id="location" class="form-control" placeholder="Vælg placering" value="5000 Odense C">
                            <input id="s-lat" v-model="latitude" type="hidden">
                            <input id="s-lon" v-model="longitude" type="hidden">
                            
                            <i class="close" v-on:click="location = ''"></i>
                            <div class="zip-results">
                                <div class="zip-codes" >
                                    <div v-for="(postal, index) in orderedZips" :key="index" v-on:click="addZip(postal.nr,postal.navn,postal.visueltcenter[1],postal.visueltcenter[0])"  class="item box mb-2">
                                        <p>{{postal.navn}} – {{postal.nr}}</p>
                                        <span>Vælg</span>                                         
                                    </div>
                                    <div>

                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Category -->
                        <div class="form-group selector">
                            <label for="">Hjælp til:</label>
                            <select name="categories" class="custom-select" id="categories-list">
                                <option disabled selected>Vælg katagori</option>
                                <option v-for="category in categories" v-bind:key="category.id"  v-bind:value="category.id">{{ category.name }}</option>
                            </select>                           
                        </div>    
                    
                        <!-- Radius -->
                        <div class="form-group">
                            <div class="d-flex justify-content-between">
                                <label for="radiusWidth">Radius</label>
                                <div class="d-flex bold">
                                    <p class="m-0" v-text="radius"></p>
                                    <p class="m-0 pl-1"> km</p>
                                </div>
                            </div>
                            <input v-model="radius" type="range" class="custom-range" min="5" max="50" step="1" id="radiusWidth">
                            <div class="faded d-flex justify-content-between">
                                <p>5 km</p>
                                <p>50 km</p>
                            </div>
                        </div>

                        <!-- Salary -->
                        <div class="form-group">
                            <div class="d-flex justify-content-between">
                                <label class="m-0" for="salaryWidth">Max. timeløn</label>
                                <div class="d-flex bold">
                                    <p class="m-0" v-text="salary"></p>
                                    <p class="m-0 pl-1"> kr</p>
                                </div>
                            </div>
                            <input v-model="salary" type="range" class="custom-range" min="50" max="400" step="1" id="salaryWidth">
                            <div class="faded d-flex justify-content-between">
                                <p>50 kr</p>
                                <p>400 kr</p>
                            </div>
                        </div>

                        <!-- Age -->
                        <div class="form-group">
                            <div class="d-flex justify-content-between">
                                <label class="m-0" for="ageWidth">Min. Alder</label>
                                <div class="d-flex bold">
                                    <p class="m-0" v-text="age"></p>
                                    <p class="m-0 pl-1"> år</p>
                                </div>
                            </div>
                            <input v-model="age" type="range" class="custom-range" min="18" max="80" step="1" id="ageWidth">
                            <div class="faded d-flex justify-content-between">
                                <p>18 år</p>
                                <p>80 år</p>
                            </div>
                        </div>

                         <!-- Category -->
                        <div class="form-group  selector">
                            <a href="" class="faded">Nulstil filter indstillinger</a>                     
                        </div> 
                    </form>
                </div>
            </div>
            <div class="hide-side" v-on:click="navBtn" v-bind:class="{ active: !showBtn }">
                <img src="/assets/icons/arrow-right.svg">
            </div>
            
        </div>
    </aside>
</template>


<script>
import axios from 'axios'
export default {
        name: "sidebar",
        prop: ['thisCategory'],
        data() {
            return {     
              showBtn: false,
              //isActive: false,
              location: '',
              zip: '',
              latitude: '',
              longitude: '',
              radius: 10,
              salary: 110,
              age: 18,
              postals: [],
              categories: [],
              newJob: null,
              selCat: this.thisCategory
            }
        },
        methods: {
            navBtn: function () {
                this.showBtn = !this.showBtn
                // some code to filter users
            },
            addZip: function (zip,op,ls,lo) {
                this.zip = zip;
                this.location = zip + " - " + op;
                this.latitude = ls;
                this.longitude = lo;
           //     this.isActive = false;
                // some code to filter users
             
            },
            distract: function (radius) {
                alert(radius);
            },
            
        },
        mounted() {
            axios.get('/data-tables/postal-codes-data.json').then(response => {
                this.postals = response.data;
            });

            axios.get('./api/categories')
                    .then(response => {
                        this.categories = response.data;
            });
            
            if (localStorage.location) {
                this.location = localStorage.location;
            }
            if (localStorage.zip) {
                this.zip = localStorage.zip;
            }
            if (localStorage.latitude) {
                this.latitude = localStorage.latitude;
            }
            if (localStorage.longitude) {
                this.longitude = localStorage.longitude;
            }
            if (localStorage.radius) {
                this.radius = localStorage.radius;
            }
            if (localStorage.age) {
                this.age = localStorage.age;
            }
            if (localStorage.salary) {
                this.salary = localStorage.salary;
            }
            if (localStorage.getItem('categories')) 
            this.categories = JSON.parse(localStorage.getItem('categories'));
            function showscroll() {
                document.body.style.overflow = 'scroll';
            }

            
        },
        computed: {
            orderedZips() {
                var numbers = '[0-9]+';
                
                if(this.location.length === 4 && this.location.match(numbers)){
                                                    return this.postals.filter(postal => { 
                                    return postal.nr.toLowerCase().includes(this.location.toLowerCase())
                                })
                    }else{
                        
                            var letters = '[a-zA-Z]+';
                            if(this.location.match(letters))
                            {
                                return this.postals.filter(postal => { 
                                    return postal.navn.toLowerCase().includes(this.location.toLowerCase())
                                })
                            }
                            else{
                                return this.postals.filter(postal => { 
                                    return postal.nr.toLowerCase().includes(this.location.toLowerCase())
                                })
                            }
                            
                        
                    }
                
                
                
     
            },
        },
        watch: {
            location(newlocation) {
                localStorage.location = newlocation;
            },
            latitude(newLatitude) {
                localStorage.latitude = newLatitude;
            },
            zip(newZip) {
                localStorage.zip = newZip;
            },
            longitude(newLongitude) {
                localStorage.longitude = newLongitude;
                
            },
            radius(newRadius) {
                localStorage.radius = newRadius;
            },
            age(newAge) {
                localStorage.age = newAge;
            },
            salary(newSalary) {
                localStorage.salary = newSalary;
            },
            categories: {
                handler() {
                    console.log('Todos changed!');
                    localStorage.setItem('categories', JSON.stringify(this.categories));
                },
                deep: true,
            },
            
        }        
    }

</script>

