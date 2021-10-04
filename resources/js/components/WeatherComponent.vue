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
                <div class="card">
                    <div class="card-header">{{ city }}</div>
                    <div class="card-body">
					    <div><span class="h3">{{ temperature }}</span> &deg;C</div>
					    <div>{{ weather }}</div>
                    </div>
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
            }
        },
        methods: {
            clickCity(city) {
                axios("/api/weather?city="+city)
                .then(response => {
                    this.city = response.data.name
                    this.temperature = response.data.main.temp
                    this.weather = response.data.weather[0].main
                    this.showCityDetails = true
                })
                .catch(error => {
                    console.log(error)
                })
            }
        }
    }
</script>