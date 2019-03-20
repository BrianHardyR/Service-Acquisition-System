<template>
  <div>
      <div>

      <span style="float:right">


      </span>
      <form action="/fetch/place" method="post" v-on:submit.prevent='getplace' style="margin:1cm;">
        <div class="input-group" style="">
            <input type="text" name="place" id="place" v-model="place" class="form-control" style="width:60%" :placeholder='location_name'>
            <span class="input-group-addon" style="float:right;">
            <input type="submit" value="Search Place" class="btn btn-primary input-group-addon">
            <a class="btn btn-primary input-group-addon" v-on:click='getlocal'> get my location </a>
            </span>
        </div>
      </form>
      </div>
      <div class="card" style="padding:0.5cm;margin-top:1cm;">


                <input type="hidden" name="latitude" id="latitude" class="form-control" v-model='coordinates.lat'>

                <input type="hidden" name="longitude" id="longitude" class="form-control" v-model='coordinates.lng'>

            <div class="form-group">
                <label for="county">County : </label>
                <input type="text" name="county" id="county" class="form-control" v-model='county'>
            </div>
            <div class="form-group">
                <label for="city">City : </label>
                <input type="text" name="city" id="city" class="form-control" v-model='city'>
            </div>
            <div class="form-group">
                <label for="district">District : </label>
                <input type="text" name="district" id="district" class="form-control" v-model='district'>
            </div>
            <div class="form-group">
                <label for="description">Description : </label>
                <input type="text" name="description" id="description" class="form-control" v-model='description'>
            </div>
            <input type="submit" class="btn btn-primary" value="add location">

      </div>
  </div>
</template>

<script>
var myservice = $("#service").val();
export default {



data(){
    return{
        position:null,
        geocoder:null,
        coordinates:{
            lat:'',
            lng:'',
        },
        reverseGeocodingParameters:{},
        location_name:'please wait',
        county:'',
        city:'',
        district:'',
        description:'',
        place:'',

    }
},
methods:{
    getlocal(){
        console.log('clicked');
        this.location_name='please wait'
        this.reverseGeocodingParameters = {
            prox: this.coordinates.lat+','+this.coordinates.lng+',150',
            mode: 'retrieveAddresses',
            maxresults: 1
        };

        this.geocoder.reverseGeocode(
        this.reverseGeocodingParameters,
        response=>{
            console.log(response);
            var address=response.Response.View[0].Result[0].Location.Address;
            this.city=address.City;
            this.county=address.County;
            this.district=address.District;
            this.description=address.Label;
            this.location_name='found';
        },
        error=>{
            console.log(error);
            this.location_name='error';
        });


    },
    getplace(){
        var geocodingParameters = {
            searchText: this.place,
            jsonattributes : 1
        };
        this.geocoder.geocode(
            geocodingParameters,
            response=>{
                console.log(response)
                var address=response.response.view[0].result[0].location.address;
                this.city=address.city;
                this.county=address.county;
                this.district=address.district;
                this.description=address.label;
            },
            error=>{
                console.log(error)
            }
        );

    }
},

mounted(){

var platform = new H.service.Platform({
    app_id: 'IvHeqzQj1UtgJEyrHIui',
    app_code: 'orzbAGFW1TEOVR2eHhG9jA',
});
// Retrieve the target element for the map:


this.position=navigator.geolocation.getCurrentPosition(response=>{
    console.log(response);
    this.coordinates = {
        lat: response.coords.latitude,
        lng: response.coords.longitude
    };
    this.location_name='ready';
    },error=>{
        console.log(error);
        alert('we cant find your location');
        this.location_name='error';
    });

this.geocoder = platform.getGeocodingService();

// Create the parameters for the reverse geocoding request:

},
}
</script>


<style>
  #mapcontainer{
    height: 20vh;
    width: 100%;
  }
</style>
