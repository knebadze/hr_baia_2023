<template lang="">
    <!-- <div class="col-md-12 "> -->
        <div class="col-md-12">
            <div class="form-group">
                <label><span class="text-danger">* </span>{{ 'მისამართი' }}</label>
                <div class="ls-inputicon-box">
                    <input class="form-control" type="text" placeholder=""  v-model="search">
                    <i class="fs-input-icon fa fa-user"></i>
                    <!-- <span v-if="v$.m.candidate[`address_${getLang}`].required.$invalid && v$.m.candidate[`address_${getLang}`].$dirty" style='color:red'>* {{ v$.m.candidate[`address_${getLang}`].required.$message}}</span> -->
                </div>
            </div>
        </div>
        <!-- <input type="text" v-model="search"> -->
        <div id="result" class="border border-2" style="box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;"><p v-for="(item, index) in results" :key="index"
            class="mt-2" :class="divHidden"><a href="javascript:void(0)" @click="chosenAddress(item)">{{ item.display_name }}</a> <hr></p> </div>
        <!-- <button type="submit" @click="searchAddress()">მოძებნა</button> -->
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
            search:null,
            results:[],
            divHidden:''
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
        },
        // searchAddress(){
        //     var key = 'pk.30ccd9a10e6073069fa62ae2434df5db'
        //     var q = this.search
        //     var url = `https://eu1.locationiq.com/v1/autocomplete?key=${key}&q=${q}&format=json`
        //     var settings = {
        //     "async": true,
        //     "crossDomain": true,
        //     "url": url,
        //     "method": "GET"
        //     }

        //     $.ajax(settings).done(function (response) {
        //     });
        // },
        chosenAddress(item){
            this.search = item.display_name

            this.divHidden = 'visually-hidden'
        }
    },
    watch: {
        'search': function (newVal, oldVal) {
            this.divHidden = ''
            var key = 'pk.30ccd9a10e6073069fa62ae2434df5db'
            var q = newVal
            var language = this.getLang
            var url = `https://eu1.locationiq.com/v1/search?key=${key}&q=${q}&accept-language=${language}&limit=20&normalizecity=1&format=json`
            var settings = {
                "async": true,
                "crossDomain": true,
                "url": url,
                "method": "GET",
            }
            let currentObj = this
            $.ajax(settings).done(function (response) {
                currentObj.results = response
            });
            // axios(settings)
            // .then(function (response) {
            //     currentObj.results = response
            // });
        },
        searchResult: {
        handler(newValue, oldValue) {

            this.sendMessageToParent(newValue)
        },
        deep: true
        },
        // 'data': function(){
        // }
    },
    mounted(){
        let That = this
        mapboxgl.accessToken = 'pk.eyJ1IjoibmVibzEwMDQiLCJhIjoiY2w5bnhhMmVpMGRiaTN2bXVyOHBrMmF2bCJ9.wMPM0gdGewsI4HbQoCvYCA';




        const map = new mapboxgl.Map({
            container: 'map', // container ID
            style: 'mapbox://styles/mapbox/satellite-streets-v12', // style URL
            center: this.markerPosition, // starting position [lng, lat]
            zoom: 9, // starting zoom
        });



        // Add the control to the map.
        // const geocoder = new MapboxGeocoder({
        //     accessToken: mapboxgl.accessToken,
        //     language: That.getLang,
        //     // mapboxgl: mapboxgl,
        //     types: 'country,region,place,postcode,locality,neighborhood',
        //     marker: false,
        //     proximity: {
        //         longitude: 44.8271,
        //         latitude: 41.7151
        //     }
        // })

        // const marker = new mapboxgl.Marker({
        //     draggable: true
        // })

        // geocoder.on('result', e => {
        //     console.log("e",e);
        //     marker.setLngLat(e.result.center)
        //     marker.addTo(map)
        //     That.searchResult['name'] = e.result.place_name
        //     That.searchResult['lngLat'] = {
        //         'lat': e.result.center[1],
        //         'lng': e.result.center[0],
        //     }
        //     // console.log('e',That.searchResult);

        // })
        // // geocoder.addTo('#geocoder');
        // map.addControl(geocoder);
        // marker.on('dragend',function(e){
        //     var lngLat = e.target.getLngLat();
        //     That.searchResult['lngLat'] = lngLat
        //     console.log(lngLat['lat'])
        //     console.log(lngLat['lng'])
        //     const features = map.queryRenderedFeatures(e.point);
        //     const displayProperties = [
        //         'type',
        //         'properties',
        //         'id',
        //         'layer',
        //         'source',
        //         'sourceLayer',
        //         'state'
        //     ];
        //     const displayFeatures = features.map((feat) => {
        //         const displayFeat = {};
        //         displayProperties.forEach((prop) => {
        //             displayFeat[prop] = feat[prop];
        //         });
        //         return displayFeat;
        //     });
        //     console.log('displayFeatures',displayFeatures);
        //     console.log(JSON.stringify( displayFeatures, null,2));
        // })
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
        }

    }
}
</script>
<style lang="" scoped>

</style>
