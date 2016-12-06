/**
 * Complete JS logic.
 * 
 * 
 * @category Class
 * @package  Ertragskarte
 * @author   Philipp Schreiber <philipp.schreiber@denkfabrik-group.com>     
 */


var ertragskarte = (function () {
  var debug = false;
  var listUrl = ["http://localhost/ertragskarte/index.php?id=1&type=3000&no_cache=1&tx_ertragskarte_ertragskarte%5Baction%5D=aggregate&tx_ertragskarte_ertragskarte%5Bcontroller%5D=Ertragskarte","http://www.rapsexperten.de/rechnertest/?type=3000&no_cache=1&tx_ertragskarte_ertragskarte%5Baction%5D=aggregate&tx_ertragskarte_ertragskarte%5Bcontroller%5D=Ertragskarte"];
  var input;
  var bounds;
  var yieldTotal=0;
  var acreageTotal=0;
  var yieldPartial=0;
  var acreagePartial=0;
  var averageYield=0;
  var searchBoxOptions = {
    componentRestrictions: {country: 'de'}
  };
  
  var searchBox;    
  var map;
  var markers = [];
  var homeMarker;
  var searchMarker;
  var myLatLng = {lat: 48.1356236, lng: 11.6589013};
  
  var mapOptions=[
          {
            featureType: "poi",
            stylers: [
             { visibility: "off" }
            ]   
           }
       ];  
  if (typeof(Number.prototype.toRadians) === "undefined") {
    Number.prototype.toRadians = function() {
      return this * Math.PI / 180;
    }
  }
      
    var range = function (start, count) {
    return Array.apply(0, Array(count))
              .map(function (element, index) { 
                       return index + start;  
                   });
    }
    var getHaversineDistance = function (lat1, lon1, lat2, lon2){
        var R = 6371; // Radius of the earth in km
        var dLat = (lat2 - lat1) * Math.PI / 180;  // deg2rad below
        var dLon = (lon2 - lon1) * Math.PI / 180;
        var a = 0.5 - Math.cos(dLat)/2 + Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) * 
           (1 - Math.cos(dLon))/2;

        return R * 2 * Math.asin(Math.sqrt(a));
   }
   
   var addMarkerListener = function (){
           /*jQuery('body').on('mouseenter touchstart','.availablesTrigger',function(e){        
                e.preventDefault();
                e.stopPropagation();
               showAvailables(this);
            });
            
            jQuery('body').on('mouseleave touchend','.availablesTrigger',function(e){
                e.preventDefault();
                e.stopPropagation();
               hideOverlay();
            });*/
            jQuery('body').on('touchstart', function(e){ 
                
               hideOverlay();
            });
          
      }
   
   var hideOverlay = function (e){                       
       jQuery('#overlay').addClass('hide').html('');
       jQuery('#overlay').offset({ top: 0, left: 0 });
       return false;
   }

    var InfoBox=function (opts) {
        google.maps.OverlayView.call(this);
        this.latlng_ = opts.latlng;
        this.map_ = opts.map;
        this.content = opts.content;
        this.offsetVertical_ = -35;
        this.offsetHorizontal_ = 5;
        this.height_ = 210;
        this.width_ = 266;
        var me = this;
        this.boundsChangedListener_ =
            google.maps.event.addListener(this.map_, "bounds_changed", function () {
                return me.panMap.apply(me);
            });
        // Once the properties of this OverlayView are initialized, set its map so
        // that we can display it. This will trigger calls to panes_changed and
        // draw.
        this.setMap(this.map_);
    }
    /* InfoBox extends GOverlay class from the Google Maps API
     */
    InfoBox.prototype = new google.maps.OverlayView();
    /* Creates the DIV representing this InfoBox
     */
    InfoBox.prototype.remove = function () {
        if (this.div_) {
            this.div_.parentNode.removeChild(this.div_);
            this.div_ = null;
        }
    };
    /* Redraw the Bar based on the current projection and zoom level
     */
    InfoBox.prototype.draw = function () {
        var h = Math.max(document.documentElement.clientHeight, window.innerHeight || 0)
        // Creates the element if it doesn't exist already.
        
        this.createElement();
        if (!this.div_) return;
        // Calculate the DIV coordinates of two opposite corners of our bounds to
        // get the size and position of our Bar
        var pixPosition = this.getProjection().fromLatLngToDivPixel(this.latlng_);
        if (!pixPosition) return;
        // Now position our DIV based on the DIV coordinates of our bounds
        this.div_.style.width = this.width_ + "px";
        this.div_.style.left = (pixPosition.x + this.offsetHorizontal_) + "px";
        this.div_.style.height = 'auto';
        
        this.div_.style.bottom = -(pixPosition.y + this.offsetVertical_) + "px";
        this.div_.style.display = 'block';
    };
    /* Creates the DIV representing this InfoBox in the floatPane. If the panes
     * object, retrieved by calling getPanes, is null, remove the element from the
     * DOM. If the div exists, but its parent is not the floatPane, move the div
     * to the new pane.
     * Called from within draw. Alternatively, this can be called specifically on
     * a panes_changed event.
     */
    InfoBox.prototype.createElement = function () {
        var panes = this.getPanes();
        var div = this.div_;
        if (!div) {
            // This does not handle changing panes. You can set the map to be null and
            // then reset the map to move the div.
            div = this.div_ = document.createElement("div");
                div.className = "infobox"
            var contentDiv = document.createElement("div");
                contentDiv.className = "content"
                contentDiv.innerHTML = this.content;
            var closeBox = document.createElement("div");
                closeBox.className = "close";
                //closeBox.innerHTML = "x";
            div.appendChild(closeBox);

           
            google.maps.event.addDomListener(closeBox, 'click', removeInfoBox(this));
            function removeInfoBox(ib) {
                return function () {
                    event.stopPropagation();
                    event.returnValue = false;
                    ib.setMap(null);
                };
            }
            div.appendChild(contentDiv);
            div.style.display = 'none';
            panes.floatPane.appendChild(div);
            this.panMap();
        } else if (div.parentNode != panes.floatPane) {
            // The panes have changed. Move the div.
            if(div.parentNode){
                
            div.parentNode.removeChild(div);
            panes.floatPane.appendChild(div);
            }
        } else {
            // The panes have not changed, so no need to create or move the div.
        }
    };
    /* Pan the map to fit the InfoBox.
     */
    InfoBox.prototype.panMap = function () {
        // if we go beyond map, pan map
        var map = this.map_;
        var bounds = map.getBounds();
        if (!bounds) return;
        // The position of the infowindow
        var position = this.latlng_;
        // The dimension of the infowindow
        var iwWidth = this.width_;
        var iwHeight = this.height_;
        // The offset position of the infowindow
        var iwOffsetX = this.offsetHorizontal_;
        var iwOffsetY = this.offsetVertical_;
        // Padding on the infowindow
        var padX = 40;
        var padY = 40;
        // The degrees per pixel
        var mapDiv = map.getDiv();
        var mapWidth = mapDiv.offsetWidth;
        var mapHeight = mapDiv.offsetHeight;
        var boundsSpan = bounds.toSpan();
        var longSpan = boundsSpan.lng();
        var latSpan = boundsSpan.lat();
        var degPixelX = longSpan / mapWidth;
        var degPixelY = latSpan / mapHeight;
        // The bounds of the map
        var mapWestLng = bounds.getSouthWest().lng();
        var mapEastLng = bounds.getNorthEast().lng();
        var mapNorthLat = bounds.getNorthEast().lat();
        var mapSouthLat = bounds.getSouthWest().lat();
        // The bounds of the infowindow
        var iwWestLng = position.lng() + (iwOffsetX - padX) * degPixelX;
        var iwEastLng = position.lng() + (iwOffsetX + iwWidth + padX) * degPixelX;
        var iwNorthLat = position.lat() - (iwOffsetY - padY) * degPixelY;
        var iwSouthLat = position.lat() - (iwOffsetY + iwHeight + padY) * degPixelY;
        // calculate center shift
        var shiftLng =
            (iwWestLng < mapWestLng ? mapWestLng - iwWestLng : 0) +
            (iwEastLng > mapEastLng ? mapEastLng - iwEastLng : 0);
        var shiftLat =
            (iwNorthLat > mapNorthLat ? mapNorthLat - iwNorthLat : 0) +
            (iwSouthLat < mapSouthLat ? mapSouthLat - iwSouthLat : 0);
        // The center of the map
        var center = map.getCenter();
        // The new map center
        var centerX = center.lng() - shiftLng;
        var centerY = center.lat() - shiftLat;
        // center the map to the new shifted center
        map.setCenter(new google.maps.LatLng(centerY, centerX));
        // Remove the listener after panning is complete.
        google.maps.event.removeListener(this.boundsChangedListener_);
        this.boundsChangedListener_ = null;
    };
  var  ZoomControl = function(controlDiv, map) {
  
        // Creating divs & styles for custom zoom control
        controlDiv.style.padding = '5px';

        // Set CSS for the control wrapper
        var controlWrapper = document.createElement('div');        
        controlWrapper.style.cursor = 'pointer';
        controlWrapper.style.textAlign = 'center';        
        
        controlDiv.appendChild(controlWrapper);

        // Set CSS for the zoomIn
        var zoomInButton = document.createElement('div');
        zoomInButton.style.width = '32px'; 
        zoomInButton.style.height = '32px';
        zoomInButton.style.backgroundColor = '#009650';
        zoomInButton.style.backgroundImage = 'url("typo3conf/ext/ertragskarte/Resources/Public/images/zoominout.png")';
        zoomInButton.style.backgroundPosition = '-32px 0px';
        zoomInButton.style.borderColor = '#fff';
        zoomInButton.style.borderWidth = '1px';
        zoomInButton.style.borderStyle = 'solid';
        zoomInButton.style.marginBottom = '2px';
        controlWrapper.appendChild(zoomInButton);

        // Set CSS for the zoomOut
        var zoomOutButton = document.createElement('div');
        zoomOutButton.style.width = '32px'; 
        zoomOutButton.style.height = '32px';
        zoomOutButton.style.backgroundColor = '#009650';
        zoomOutButton.style.borderColor = '#fff';
        zoomOutButton.style.borderWidth = '1px';
        zoomOutButton.style.borderStyle = 'solid';
        /* Change this to be the .png image you want to use */
        zoomOutButton.style.backgroundImage = 'url("typo3conf/ext/ertragskarte/Resources/Public/images/zoominout.png")';
        
        controlWrapper.appendChild(zoomOutButton);

        // Setup the click event listener - zoomIn
        google.maps.event.addDomListener(zoomInButton, 'click', function() {
          map.setZoom(map.getZoom() + 1);
        });
        google.maps.event.addDomListener(zoomOutButton, 'click', function() {
            
                map.setZoom(map.getZoom() - 1);
            
        });
    }
    
  var placeMarker = function (location) {
    jQuery('#newMarkersForm input[name*="[lng]"').val(location.lng());
    jQuery('#newMarkersForm input[name*="[ltd]"').val(location.lat());
    jQuery.ajax({
       type:'POST',
       dataType: 'JSON',
       url:'https://maps.googleapis.com/maps/api/geocode/json?latlng='+location.lat()+','+location.lng()+'&key=AIzaSyBhhaaDitPwEYgmZGTElQZNLnB_LrSTIpw',
       success:function(data){
           if(data){
               var plz = data.results[0].address_components.filter(function(val){
                  if(val.types[0]=="postal_code"){
                      return true;
                  }
               });
               jQuery('#newMarkersForm input[name*="[zip]"]').val(plz[0].long_name);
               
           }
           
           
           jQuery('#newMarkersModal').modal('show');
            var marker = new google.maps.Marker({
                position: location, 
                map: map,
                icon: "typo3conf/ext/ertragskarte/Resources/Public/images/yield-icon-own.png"
            });
            markers.push(marker);
       }
    });
    
    
   }; 
  var updateAverage = function(){
      
      jQuery('#average span').html(Math.round(yieldPartial/acreagePartial*100)/100);
  }
  var checkVisibleElements = function(elementsArray, bounds) {
        //checks if marker is within viewport and displays the marker accordingly - triggered by google.maps.event "idle" on the map Object
        yieldPartial=0;
        acreagePartial=0;
        elementsArray.forEach(function (item) {
            //If the item is within the the bounds of the viewport
            
            if (bounds.contains(item.position) && item.display == true) {
                //If the item isn't already being displayed
                yieldPartial += item.yield;
                acreagePartial += item.acreage;
                if (item.map!=map){
                item.setMap(map);                
                }
            } else {
            
                item.setMap(null);
            }
        });
        updateAverage();
        //new MarkerClusterer(map, elementsArray, {imagePath: 'images/m'});
   }; 
  var addSearchListener = function (){
          searchBox.addListener('place_changed', function() {
                var place = searchBox.getPlace();
                
                if (place.geometry == undefined) {
                  return;
               }                
                
                
                  homeMarker.setMap(null);
                
                  var icon = {
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(25, 25)
                  };
                  
                  myLatLng = {lat: place.geometry.location.lat(), lng: place.geometry.location.lng(),getLat:function(){return this.lat;},getLng:function(){return this.lng;}};
                  
                  
 

               homeMarker = new google.maps.Marker({
                position: myLatLng,
                map: map,
                icon: 'home.png'
              });                                   
        
                homeMarker.setMap(map);
                map.setCenter(myLatLng);
              });
      }; 
  var isLoggedIn = function(){
        if(!document.cookie){
            return false;
        }
        var checkVal = document.cookie.split(";").filter(function(value){
            var pair = value.split("=");
            if(pair[0] == 'checkVal' || value.split("=")[0] == ' checkVal'){                
                return true;
            }
        });
        
        if(checkVal.length==0){
            return false;
        }
        
        return checkVal.every(function(value){
           if(value.split("=")[1]==1){
               return true;
           } 
        });
        
        
  };
  var addGeneralListener = function(){
    google.maps.event.addListener(map, 'click', function(event) {
        if(isLoggedIn()){
            placeMarker(event.latLng);
        }else{
            jQuery("#newMarkersModalFailure .content").html("Sie müssen sich anmelden, um Marker setzen zu können.");
            jQuery("#newMarkersModalFailure").modal('show');
        }
        
        
        
    });  
    jQuery("#newMarkersForm").submit(function(e){
       e.preventDefault();
       
       var url = jQuery(this)[0].action;
       var formData = jQuery(this).serialize();
       jQuery.ajax({
          type        : 'POST',
          url         : url,
          data        : formData,          
          success : function(response){
              if(response==1){
              jQuery('.ui.modal').modal('hide');
              jQuery('#newMarkersModalSuccess').modal('show');
              }else{
                jQuery('.ui.modal').modal('hide'); 
                jQuery("#newMarkersModalFailure .content").html("Sie müssen sich anmelden, um Marker setzen zu können.");
                jQuery("#newMarkersModalFailure").modal('show');
              }
          },
          error:function(e){
              jQuery('.ui.modal').modal('hide');
              jQuery("#newMarkersModalFailure .content").html(e);
              jQuery("#newMarkersModalFailure").modal('show');
              
          }
       });
    });
  };
  var findClosest = function (){
        var closestloc;
        var smallestSoFar=0;
        markers.forEach(function(value){              
            if(value.display===true && jQuery.isNumeric(value.position.lat())){                  
              var distance=Math.round(getHaversineDistance(value.position.lat(),value.position.lng(),myLatLng.lat,myLatLng.lng));                                                
                      var newLatlng = new google.maps.LatLng(value.position.lat(), value.position.lng());
                      if(smallestSoFar ===0 || distance< smallestSoFar){
                          closestloc=newLatlng;
                          smallestSoFar=distance;
                      }
            }           
        });
                 
        var newbounds = new google.maps.LatLngBounds();
         
        newbounds.extend(new google.maps.LatLng(myLatLng.lat, myLatLng.lng));
        if(closestloc){
            newbounds.extend(closestloc);
        }
        map.fitBounds(newbounds);
        
        map.setZoom(map.getZoom()-1);
        map.setCenter(newbounds.getCenter());
            
            
            
          
      };     
  var setHombase=function(){
          
          map = new google.maps.Map(document.getElementById('map'), {
                mapTypeControl: false,
                streetViewControl: false,
                zoom: 10,
                center: myLatLng,
                mapTypeId: google.maps.MapTypeId.ROADMAP,
                disableDefaultUI: true
              });
              map.setOptions({styles: mapOptions});
            var zoomControlDiv = document.createElement('div');
            
            var zoomControl = new ZoomControl(zoomControlDiv, map);

            zoomControlDiv.index = 1;
            map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(zoomControlDiv);
              
            jQuery('#localize').show();
            addSearchListener();
            addMarkerListener();         
            addGeneralListener();
          
      };
  var buildItNow = function (){
        var icon = ['typo3conf/ext/ertragskarte/Resources/Public/images/yield-icon-reg.png','typo3conf/ext/ertragskarte/Resources/Public/images/yield-icon-own.png','typo3conf/ext/ertragskarte/Resources/Public/images/yield-icon-baywa.png'];
        
        jQuery.ajax({
              dataType: "json",
                url: debug ? listUrl[0] : listUrl[1],                
                success: function(data) {  
                   
                    jQuery.each( data, function(i, value) {                                                   
                        var newLatlng = new google.maps.LatLng(value.ltd,value.lng);
                        var curIcon = icon[0];
                        if(value.curUser==1){
                            curIcon = icon[1];
                        }else if(value.curUser==-1){
                            curIcon = icon[2];
                        }
                        yieldTotal += value.yield;
                        acreageTotal += value.acreage;
                        var image = {
                            url: curIcon,                    
                            size: new google.maps.Size(80, 80),
                            scaledSize:new google.maps.Size(40, 40),                            
                            origin: new google.maps.Point(0, 0),                            
                            anchor: new google.maps.Point(20,40)
                          };
                        var marker=new google.maps.Marker({
                        position: newLatlng,
                        map: map,
                        icon: image,
                        contentfix: '<div class="content"><div><h3>'+value.title+'</h3><div class="innercontent"><strong>durchschnittl. Ertrag: '+Math.round((value.yield/value.acreage)*100)/100+' Tonnen/ha</strong><br></div></div></div>',                        
                        display: true,
                        yield:value.yield,
                        acreage:value.acreage
                        });
                        markers.push(marker);
                        var markerEvent =  function (e) {
                            //map.setCenter(newLatlng);
                            jQuery('.infobox').remove();
                            var infoBox = new InfoBox({
                                latlng: newLatlng,
                                map: map,
                                content: marker.contentfix

                            }); 
                            };
                        google.maps.event.addListener(marker, 'click',
                             markerEvent
                          );
                        google.maps.event.addListener(marker, 'mouseover',
                             markerEvent
                          );  
                         
                    });                                     
                    averageYield = Math.round(yieldTotal/acreageTotal*100)/100;
                    jQuery('#averageTotal span').html(averageYield);
                    google.maps.event.addListener(map, "idle", function (event) {                                                
                            bounds = map.getBounds();
                            checkVisibleElements(markers, bounds);                        
                    });
                    google.maps.event.addListener(map, "zoom_changed", function (event) {                                                
                        
                        if(map.getZoom()<7){
                            map.setZoom(7);
                        }
                        
                            
                    });                                        
                    findClosest();                                        
                },
                error:function(e){
                    console.log(e);
                }
        });
    }
        
       
          
     
  var initialize= function(){
      bounds = new google.maps.LatLngBounds()
      input = jQuery('#pac-input').get(0);
      searchBox = new google.maps.places.Autocomplete(input,searchBoxOptions);
      
      setHombase();      
      buildItNow();
  };
  
  
  return {
    initialize: initialize
    
  }
})();






$(document).ready(function(jQuery){
    ertragskarte.initialize();
});