<template>
  <div>
    <div id="mapcontainer">

    </div>
  </div>
</template>

<script>
export default {
    data(){
      return{
        map:null,
        coordinates:{
            lat:0,
            lng:0
        },
        zoom:17,
        marker:null,
        mapPlaceholder:null,
        maptypes:null,

      };
  },


  mounted () {
    // Initialize the platform object:
    const platform = new H.service.Platform({
      app_id: 'IvHeqzQj1UtgJEyrHIui',
      app_code: 'orzbAGFW1TEOVR2eHhG9jA',
      useCIT: true,
      useHTTPS: true,
    });

    this.maptypes = platform.createDefaultLayers();

    // Instantiate (and display) a map object:
    this.mapPlaceholder = document.getElementById('mapcontainer');

     var mapOptions = {
        center: this.coordinates,
        zoom: this.zoom
    }

    this.position=navigator.geolocation.getCurrentPosition(response=>{
        this.coordinates = {
        lat: response.coords.latitude,
        lng: response.coords.longitude
    };
    },error=>{
        console.log(error);
        alert('we cant find your location');
    });




    this.map = new H.Map(this.mapPlaceholder,
    this.maptypes.satellite.map,
    mapOptions);

    var behavior = new H.mapevents.Behavior(new H.mapevents.MapEvents(this.map));
    //console.log(behavior);
    this.marker = new H.map.Marker(this.coordinates);
    this.map.addObject(this.marker);

    setInterval(function () {
        this.marker.setPosition(this.coordinates);
        this.map.removeObject(this.marker);
        this.map.addObject(this.marker);
        this.map.setCenter(this.coordinates);
        this.map.getViewPort().resize();
        console.log(this.coordinates);
        }.bind(this), 5000);

  },
  ready:function(){

  }

}
</script>


<style>
  #mapcontainer{
    height: 100vh;
    width: 100%;
  }
</style>
