<template>
    <div class="container">
        <div class="links">
            <a href="#" @click="clickCity('Tokyo')">Tokyo</a>
            <a href="#" @click="clickCity('Yokohama')">Yokohama</a>
            <a href="#" @click="clickCity('Kyoto')">Kyoto</a>
            <a href="#" @click="clickCity('Osaka')">Osaka</a>
            <a href="#" @click="clickCity('Sapporo')">Sapporo</a>
            <a href="#" @click="clickCity('Nagoya')">Nagoya</a>
        </div>
        <div v-if="showCityDetails" class="row justify-content-center">
            <div class="col-md-8">
                <div class="card mt-4">
                    <div class="card-header">{{ city }}</div>
                    <div class="card-body">
                        <div><span class="h3">{{ temperature }}</span> <span>&deg;C</span></div>
                        <div>{{ weather }}</div>
                        <div>Sunrise: {{ sunriseTime }} / Sunset: {{ sunsetTime }}</div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-start">
            <div class="col-md-8">
                <h3 class="mb-0 mt-2" v-if="showCityDetails">Places to visit in: {{ city }}</h3>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="row">
                    <template v-for="(venue, index) in venues">
                        <div class="col-md-6" :key="index">
                            <div class="card mt-4">
                                <div class="card-header">{{ venue.name }}</div>
                                <div class="card-body">
                                    <ul class="list-unstyled">
                                        <li>Short Description: {{ venue.description }}</li>
                                        <li>Address: <a :href="venue.map_link" target="_blank">{{ venue.address }}</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </template>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import axios from 'axios'

    export default {
        data() {
            return {
                showCityDetails: false,
                city: "",
                temperature: null, 
                weather: "",
                sunriseTime: null,
                sunsetTime: null,
                venues: []
            }
        },
        methods: {
            clickCity(city) {
                axios("/api/weather?city="+city)
                .then(response => {
                    this.city = response.data.city
                    this.temperature = response.data.main.temp
                    this.weather = response.data.weather.map(w => w.main).join(", ")
                    this.sunriseTime = response.data.main.sunrise
                    this.sunsetTime = response.data.main.sunset
                    this.venues = response.data.venues
                    this.showCityDetails = true
                })
                .catch(error => {
                    console.log(error)
                })
            }
        }
    }
</script>