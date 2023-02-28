<template lang="">
    <!-- <div class="col-md-12 "> -->
        <div id="geocoder" class="geocoder mb-3" :style="styleGeocoder"></div>
    <!-- </div> -->
    <div id='map' style='width: 100%; height: 400px;'></div>
    <pre id="coordinates" class="coordinates"></pre>

</template>
<script>
export default {
    props:{
        data: String
    },
    data() {
        return {
            m: null,
            search: 'Tbilis',
            styleGeocoder: {
                // position: 'absolute',
                zIndex: '1',
                width: '100%',
                height: '30px'
                // left: '50%',
                // marginLeft: '-25%',
                // top: '10px',
            },
            searchResult: {},
            markerPosition:[44.8271,41.7151],
            addressInput:'',
            // longLat: null
        }
    },
    created(){
        // this.addressInput = this.data
    },
    computed:{
        getLang(){
            return I18n.getSharedInstance().options.lang
        },
    },
    methods:{
        sendMessageToParent(arg){
            this.$emit('messageFromChild', arg)
        }
    },
    watch: {
        searchResult: {
        handler(newValue, oldValue) {
            console.log('newValue', newValue);
            this.sendMessageToParent(newValue)
        },
        deep: true
        },
        // 'data': function(){
        //     console.log('data', this.data);
        // }
    },
    mounted(){
        let That = this
        mapboxgl.accessToken = 'pk.eyJ1IjoibmVibzEwMDQiLCJhIjoiY2w5bnhhMmVpMGRiaTN2bXVyOHBrMmF2bCJ9.wMPM0gdGewsI4HbQoCvYCA';
        // const mapboxClient = mapboxSdk({ accessToken: mapboxgl.accessToken });
        // var address = this.addressInput
        // console.log('address', address);
        // if (address != null) {
        //     mapboxClient.geocoding
        //     .forwardGeocode({
        //         query: address,
        //         autocomplete: false,
        //         limit: 1
        //     })
        //     .send()
        //     .then((response) => {
        //         if (
        //             !response ||
        //             !response.body ||
        //             !response.body.features ||
        //             !response.body.features.length
        //         ) {
        //             console.error('Invalid response:');
        //             console.error(response);
        //             return;
        //         }
        //         const responseFeature = response.body.features[0];
        //         // this.markerPosition =  responseFeature.center
        //         console.log('responseFeature', responseFeature );
        //     })
        // }



        const map = new mapboxgl.Map({
            container: 'map', // container ID
            style: 'mapbox://styles/mapbox/satellite-streets-v12', // style URL
            center: this.markerPosition, // starting position [lng, lat]
            zoom: 9, // starting zoom
        });



        // Add the control to the map.
        const geocoder = new MapboxGeocoder({
            accessToken: mapboxgl.accessToken,
            language: That.getLang,
            mapboxgl: mapboxgl,
            types: 'country,region,place,postcode,locality,neighborhood',
            marker: false,
            proximity: {
                longitude: 44.8271,
                latitude: 41.7151
            }
        })

        const marker = new mapboxgl.Marker({
            draggable: true
        })
        // console.log();

        geocoder.on('result', e => {

            marker.setLngLat(e.result.center)
            marker.addTo(map)
            That.searchResult['name'] = e.result.place_name
            That.searchResult['lngLat'] = {
                'lat': e.result.center[1],
                'lng': e.result.center[0],
            }
            // console.log('e',That.searchResult);

        })
        // geocoder.addTo('#geocoder');
        map.addControl(geocoder);
        marker.on('dragend',function(e){
            var lngLat = e.target.getLngLat();
            That.searchResult['lngLat'] = lngLat
            console.log(lngLat['lat'])
            console.log(lngLat['lng'])
            const features = map.queryRenderedFeatures(e.point);
            const displayProperties = [
                'type',
                'properties',
                'id',
                'layer',
                'source',
                'sourceLayer',
                'state'
            ];
            const displayFeatures = features.map((feat) => {
                const displayFeat = {};
                displayProperties.forEach((prop) => {
                    displayFeat[prop] = feat[prop];
                });
                return displayFeat;
            });
            console.log('displayFeatures',displayFeatures);
            console.log(JSON.stringify( displayFeatures, null,2));
        })
        //add full screen control
        map.addControl(new mapboxgl.FullscreenControl());

        // Add zoom and rotation controls to the map.
        map.addControl(new mapboxgl.NavigationControl());


        // Add geolocate control to the map.
        let geolocate = new mapboxgl.GeolocateControl({
            positionOptions: {
                enableHighAccuracy: true
            },
            // When active the map will receive updates to the device's location as it changes.
            trackUserLocation: false,
            // Draw an arrow next to the location dot to indicate which direction the device is heading.
            showUserHeading: true
        })
        map.addControl(geolocate);
        // map.on("load", function () {
        //     geolocate.trigger(); // add this if you want to fire it by code instead of the button
        // });
        geolocate.on("geolocate", locateUser);

        function locateUser(e) {
            console.log("A geolocate event has occurred.", e);
            console.log("lng:" + e.coords.longitude + ", lat:" + e.coords.latitude);
        }

    }
}
</script>
<style lang="" scoped>

</style>
