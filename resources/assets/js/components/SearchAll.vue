<template>
    <div>
        <form action="/search" method="post" style="width:100%;font-color:white;"
        v-on:submit.prevent='getresult'>
            <span style="float:left;
                        width:88%">

                <input type='text'
                        id="search"
                        name="search"
                        :placeholder="'search in '+location"
                        class="form-control"
                        style="width:100%"
                        v-model="search"
                        v-on:keyup='getresult'
                        >
                <input type="hidden" id="city" name="city" :value="city">
                <input type="hidden" id="county" name="county" :value="county">
                <input type="hidden" id="district" name="district" :value="district">
                <input type="hidden" id="description" name="description" :value="description">
                <input type="hidden" id="country" name="country" :value="country">
            </span>
            <span style="float:right;
                        width:12%">
                <input type="submit" value="search" class="btn btn-primary" style="width:100%;">
            </span>
        </form>
        <div class="card" style="width:100%;background-color:rgba(255,255,255,0.9);padding:0.3cm;"
            v-if="search!=''"
        >
            <div style="padding:5px" v-for="service in result.service" :key="service.id">
                <a :href="'/service/search/'+service.id" style="color:black;font-size:15;">
                    {{ service.name }} at {{ service.ask_price }} /=
                </a>
            </div>
            <div style="padding:5px" v-for="provider in result.provider" :key="provider.id">
                <a :href="'/provider/'+provider.id" style="color:black;font-size:15">
                    {{ provider.name }} -> {{ provider.email }}
                </a>
            </div>

        </div>
    </div>
</template>
<script>
export default {

    data(){
        return{
            search:'',
            location:'',
            coords:{
                lat:0,
                lng:0.
            },

                county:'',
                city:'',
                district:'',
                description:'',
                country:'',

            result:{
                service:{},
                provider:{}
            }
        }
    },
    mounted(){
        navigator.geolocation.getCurrentPosition(
            response=>{
                this.coords={
                    lat:response.coords.latitude,
                    lng:response.coords.longitude
                }
                var platform = new H.service.Platform({
                    app_id: 'IvHeqzQj1UtgJEyrHIui',
                    app_code: 'orzbAGFW1TEOVR2eHhG9jA',
                });
                var geocoder = platform.getGeocodingService();
                var reverseGeocodingParameters = {
                    prox: this.coords.lat+','+this.coords.lng+',150',
                    mode: 'retrieveAddresses',
                    maxresults: 1
                };
                geocoder.reverseGeocode(
                    reverseGeocodingParameters,
                    response=>{
                        console.log(response);
                        this.location=response.Response.View[0].Result[0].Location.Address.Label;
                        var address=response.Response.View[0].Result[0].Location.Address;
                        this.city=address.City;
                        this.county=address.County;
                        this.district=address.District;
                        this.description=address.Label;
                        this.country=address.AdditionalData[0].value;
                    },
                    error=>{
                        console.log(error);
                    }
                );
            },
            error=>{
                console.log(error);
                alert('you either dont have active internet or have location service turned off');
            }
        );

    },

    methods:{
        getresult(){
            if(this.search!=''){

                var data={
                    search: this.search,
                    city: this.city,
                    country: this.county,
                    district: this.district,
                    country: this.country
                    };
                console.log(data);
                 axios.post('/search',data)
                    .then(response=>{

                        this.result=response.data;

                    })
                    .catch(error=>{

                    });
            }
        }
    }

}
</script>

