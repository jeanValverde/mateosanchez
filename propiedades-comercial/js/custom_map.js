        function initialize() {
    'use strict';
            var secheltLoc = new google.maps.LatLng(49.47216, -123.76307), // Main Map Latitude and Longitude
            markers,
            myMapOptions = {
                    zoom: 13,
                    scrollwheel: false,
                    center: secheltLoc,
                    mapTypeId: google.maps.MapTypeId.ROADMAP
                },
                map = new google.maps.Map(document.getElementById("map"), myMapOptions);

            function initMarkers(map, markerData) {
                var newMarkers = [],
                    marker;

                for (var i = 0; i < markerData.length; i++) {
                    var pictureLabel = document.createElement("img");
                    pictureLabel.src = markerData[i].markLabl;
                    var boxText = document.createElement("div");
                    //these are the options for all infoboxes
                    var infoboxOptions = {
                        content: boxText,
                        disableAutoPan: false,
                        maxWidth: 0,
                        pixelOffset: new google.maps.Size(-180, -360),
                        zIndex: null,
                        boxStyle: {
                            opacity: 1,
                            width: "auto"
                        },
                        closeBoxMargin: "0",
                        closeBoxURL: "images/close_btn.jpg",
                        infoBoxClearance: new google.maps.Size(1, 1),
                        isHidden: false,
                        pane: "floatPane",
                        enableEventPropagation: true
                    };

                    marker = new MarkerWithLabel({
                        title: markerData[i].loc,
                        map: map,
                        draggable: false,
                        icon: 'images/marker.png',
                        position: markerData[i].latLng,
                        visible: true,
                        labelContent: pictureLabel,
                        labelAnchor: new google.maps.Point(50, 0),
                    });

                    newMarkers.push(marker);
                    //define the text and style for all infoboxes
                    boxText.style.cssText = "";
                    boxText.innerHTML = '<div class="col-xs-12 p0"><div class="panel panel-default"><div class="panel-image"><img class="img-responsive img-hover" src="' + markerData[i].propImg + '" alt=""></div><div class="panel-body"><h3 class="sec_titl">' + markerData[i].propTitle + ' </h3><div class="col_labls"><p class="or_labl">' + markerData[i].for+'</p><p class="blu_labl"> ' + markerData[i].price + '</p></div><div class="prop_feat"><p class="area"><i class="fa fa-home"></i>' + markerData[i].area + '</p><p class="bedrom"><i class="fa fa-bed"></i>' + markerData[i].propInfo + '</p><p class="bedrom"><i class="fa fa-car"></i>' + markerData[i].propInfo2 + '</p></div></div></div></div>';
                    //Define the infobox
                    newMarkers[i].infobox = new InfoBox(infoboxOptions);
                    //Open box when page is loaded
                    newMarkers[i].infobox.close(map, marker);
                    //Add event listen, so infobox for marker is opened when user clicks on it.  Notice the return inside the anonymous function - this creates
                    //a closure, thereby saving the state of the loop variable i for the new marker.  If we did not return the value from the inner function, 
                    //the variable i in the anonymous function would always refer to the last i used, i.e., the last infobox. This pattern (or something that
                    //serves the same purpose) is often needed when setting function callbacks inside a for-loop.
                    google.maps.event.addListener(marker, 'click', (function (marker, i) {
                        return function () {
                            var h;
                            for (h = 0; h < newMarkers.length; h++) {
                                newMarkers[h].infobox.close();
                            }
                            newMarkers[i].infobox.open(map, this);
                            map.panTo(markerData[i].latLng);
                        }
                    })(marker, i));
                }

                return newMarkers;
            }

            //here the call to initMarkers() is made with the necessary data for each marker.  All markers are then returned as an array into the markers variable
            markers = initMarkers(map, [
  // Marker 1 
                {
                    loc: 'powai',
                    latLng: new google.maps.LatLng(49.47216, -123.76307),
                    propImg: 'images/property/property_2.jpg',
                    propTitle: 'Amillarah Private Islands',
                    for: 'For Saless',
                    price: '$3200',
                    area: '5000 Sq Ft',
                    propInfo: '3 Bedrooms',
                    propInfo2: '1 Garage',
                    markLabl: 'images/apartment.png'
                },
  // Marker 2 
                {
                    loc: 'sakinaka',
                    latLng: new google.maps.LatLng(49.47620, -123.75703),
                    propImg: 'images/property/property_2.jpg',
                    propTitle: 'Amillarah Private Islands',
                    for: 'For Sales',
                    price: '$3200',
                    area: '5000 Sq Ft',
                    propInfo: '3 Bedrooms',
                    propInfo2: '1 Garage',
                    markLabl: 'images/apartment.png'
                },
  // Marker 3 
                {
                    loc: 'andheri',
                    latLng: new google.maps.LatLng(49.47830, -123.78040),
                    propImg: 'images/property/property_2.jpg',
                    propTitle: 'Amillarah Private Islands',
                    for: 'For Sales',
                    price: '$3200',
                    area: '5000 Sq Ft',
                    propInfo: '3 Bedrooms',
                    propInfo2: '1 Garage',
                    markLabl: 'images/cottage.png'
                },
        // Marker 4
                {
                    loc: 'kurla',
                    latLng: new google.maps.LatLng(49.47756, -123.70240),
                    propImg: 'images/property/property_2.jpg',
                    propTitle: 'Amillarah Private Islands',
                    for: 'For Sales',
                    price: '$3200',
                    area: '5000 Sq Ft',
                    propInfo: '3 Bedrooms',
                    propInfo2: '1 Garage',
                    markLabl: 'images/cottage.png'
                },
        // Marker 5
                {
                    loc: 'nariman point',
                    latLng: new google.maps.LatLng(49.46105, -123.73776),
                    propImg: 'images/property/property_2.jpg',
                    propTitle: 'Amillarah Private Islands',
                    for: 'For Sales',
                    price: '$3200',
                    area: '5000 Sq Ft',
                    propInfo: '3 Bedrooms',
                    propInfo2: '1 Garage',
                    markLabl: 'images/apartment.png'
                },
        // Marker 6
                {
                    loc: 'nariman point',
                    latLng: new google.maps.LatLng(49.48180, -123.74137),
                    propImg: 'images/property/property_2.jpg',
                    propTitle: 'Amillarah Private Islands',
                    for: 'For Sales',
                    price: '$3200',
                    area: '5000 Sq Ft',
                    propInfo: '3 Bedrooms',
                    propInfo2: '1 Garage',
                    markLabl: 'images/cottage.png'
                },
        // Marker 7
                {
                    loc: 'nariman point',
                    latLng: new google.maps.LatLng(49.50009, -123.78840),
                    propImg: 'images/property/property_2.jpg',
                    propTitle: 'Amillarah Private Islands',
                    for: 'For Sales',
                    price: '$3200',
                    area: '5000 Sq Ft',
                    propInfo: '3 Bedrooms',
                    propInfo2: '1 Garage',
                    markLabl: 'images/apartment.png'
                },
        // Marker 8
                {
                    loc: 'nariman point',
                    latLng: new google.maps.LatLng(49.48428, -123.87603),
                    propImg: 'images/property/property_2.jpg',
                    propTitle: 'Amillarah Private Islands',
                    for: 'For Sales',
                    price: '$3200',
                    area: '5000 Sq Ft',
                    propInfo: '3 Bedrooms',
                    propInfo2: '1 Garage',
                    markLabl: 'images/cottage.png'
                },
        //Marker  9
                {
                    loc: 'nariman point',
                    latLng: new google.maps.LatLng(49.48804, -123.83132),
                    propImg: 'images/property/property_2.jpg',
                    propTitle: 'Amillarah Private Islands',
                    for: 'For Sales',
                    price: '$3200',
                    area: '5000 Sq Ft',
                    propInfo: '3 Bedrooms',
                    propInfo2: '1 Garage',
                    markLabl: 'images/cottage.png'
                },
        //Marker  10
                {
                    loc: 'nariman point',
                    latLng: new google.maps.LatLng(49.46964, -123.85672),
                    propImg: 'images/property/property_2.jpg',
                    propTitle: 'Amillarah Private Islands',
                    for: 'For Sales',
                    price: '$3200',
                    area: '5000 Sq Ft',
                    propInfo: '3 Bedrooms',
                    propInfo2: '1 Garage',
                    markLabl: 'images/cottage.png'
                },
        //Marker  11
                {
                    loc: 'nariman point',
                    latLng: new google.maps.LatLng(49.50231, -123.71047),
                    propImg: 'images/property/property_2.jpg',
                    propTitle: 'Amillarah Private Islands',
                    for: 'For Sales',
                    price: '$3200',
                    area: '5000 Sq Ft',
                    propInfo: '3 Bedrooms',
                    propInfo2: '1 Garage',
                    markLabl: 'images/cottage.png'
                },
        //Marker  12
                {
                    loc: 'nariman point',
                    latLng: new google.maps.LatLng(49.46774, -123.81587),
                    propImg: 'images/property/property_2.jpg',
                    propTitle: 'Amillarah Private Islands',
                    for: 'For Sales',
                    price: '$3200',
                    area: '5000 Sq Ft',
                    propInfo: '3 Bedrooms',
                    propInfo2: '1 Garage',
                    markLabl: 'images/cottage.png'
                },
        //Marker  13 
                {
                    loc: 'nariman point',
                    latLng: new google.maps.LatLng(49.47488, -123.71905),
                    propImg: 'images/property/property_2.jpg',
                    propTitle: 'Amillarah Private Islands',
                    for: 'For Sales',
                    price: '$3200',
                    area: '5000 Sq Ft',
                    propInfo: '3 Bedrooms',
                    propInfo2: '1 Garage',
                    markLabl: 'images/cottage.png'
                },
        //Marker  14
                {
                    loc: 'nariman point',
                    latLng: new google.maps.LatLng(49.47187, -123.66892),
                    propImg: 'images/property/property_2.jpg',
                    propTitle: 'Amillarah Private Islands',
                    for: 'For Sales',
                    price: '$3200',
                    area: '5000 Sq Ft',
                    propInfo: '3 Bedrooms',
                    propInfo2: '1 Garage',
                    markLabl: 'images/cottage.png'
                },
        //Marker  15
                {
                    loc: 'nariman point',
                    latLng: new google.maps.LatLng(49.49652, -123.76196),
                    propImg: 'images/property/property_2.jpg',
                    propTitle: 'Amillarah Private Islands',
                    for: 'For Sales',
                    price: '$3200',
                    area: '5000 Sq Ft',
                    propInfo: '3 Bedrooms',
                    propInfo2: '1 Garage',
                    markLabl: 'images/cottage.png'
                },
        //Marker  16
                {
                    loc: 'nariman point',
                    latLng: new google.maps.LatLng(49.49373, -123.67888),
                    propImg: 'images/property/property_2.jpg',
                    propTitle: 'Amillarah Private Islands',
                    for: 'For Sales',
                    price: '$3200',
                    area: '5000 Sq Ft',
                    propInfo: '3 Bedrooms',
                    propInfo2: '1 Garage',
                    markLabl: 'images/cottage.png'
                },
        //Marker  17
                {
                    loc: 'nariman point',
                    latLng: new google.maps.LatLng(49.45960, -123.68884),
                    propImg: 'images/property/property_2.jpg',
                    propTitle: 'Amillarah Private Islands',
                    for: 'For Sales',
                    price: '$3200',
                    area: '5000 Sq Ft',
                    propInfo: '3 Bedrooms',
                    propInfo2: '1 Garage',
                    markLabl: 'images/cottage.png'
                },
        //Marker  18
                {
                    loc: 'nariman point',
                    latLng: new google.maps.LatLng(49.49529, -123.85878),
                    propImg: 'images/property/property_2.jpg',
                    propTitle: 'Amillarah Private Islands',
                    for: 'For Sales',
                    price: '$3200',
                    area: '5000 Sq Ft',
                    propInfo: '3 Bedrooms',
                    propInfo2: '1 Garage',
                    markLabl: 'images/cottage.png'
                },
        //Marker 19
                {
                    loc: 'nariman point',
                    latLng: new google.maps.LatLng(49.48319, -123.82007),
                    propImg: 'images/property/property_2.jpg',
                    propTitle: 'Amillarah Private Islands',
                    for: 'For Sales',
                    price: '$3200',
                    area: '5000 Sq Ft',
                    propInfo: '3 Bedrooms',
                    propInfo2: '1 Garage',
                    markLabl: 'images/cottage.png'
                },
        //Marker 20
                {
                    loc: 'nariman point',
                    latLng: new google.maps.LatLng(49.45798, -123.81252),
                    propImg: 'images/property/property_2.jpg',
                    propTitle: 'Amillarah Private Islands',
                    for: 'For Sales',
                    price: '$3200',
                    area: '5000 Sq Ft',
                    propInfo: '3 Bedrooms',
                    propInfo2: '1 Garage',
                    markLabl: 'images/apartment.png'
                },

    ]);
        }

