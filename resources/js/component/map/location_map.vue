<template lang="">
   <div id='map' style='width: 100%; height: 270px;'></div>
</template>
<script>
export default {
    props:{
        markerPosition:Array
    },
    data() {
        return {
            // markerPosition1:[44.8271,41.7151],
        }
    },
    created(){

    },
    computed:{
        getLang(){
            return I18n.getSharedInstance().options.lang
        },
    },
    watch:{

    },
    mounted() {
        mapboxgl.accessToken = 'pk.eyJ1IjoibmVibzEwMDQiLCJhIjoiY2w5bnhhMmVpMGRiaTN2bXVyOHBrMmF2bCJ9.wMPM0gdGewsI4HbQoCvYCA';
        const map = new mapboxgl.Map({
            container: 'map', // container ID
            style: 'mapbox://styles/mapbox/streets-v12', // style URL
            center: this.markerPosition, // starting position [lng, lat]
            zoom: 12, // starting zoom
        });
        const marker = new mapboxgl.Marker()
            .setLngLat(this.markerPosition)
            .addTo(map);
    },
}
</script>
<style lang="">

</style>
