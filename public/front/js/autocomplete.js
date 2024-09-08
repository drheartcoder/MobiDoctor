var glob_autocomplete;
var glob_component_form = 
{
    street_number               : 'short_name',
    route                       : 'long_name',
    locality                    : 'long_name',
    sublocality                 : 'long_name',
    postal_code                 : 'short_name',
    country                     : 'long_name',
    administrative_area_level_1 : 'long_name'
};

var glob_marker    = false;
var glob_map       = false;
var glob_options   = { };
glob_options.types = [];

function changeCountryRestriction(ref)
{
    var country_code = $(ref).val();
    destroyPlaceChangeListener(autocomplete);
    // $('#property_map').show();
    initAutocomplete();
    glob_autocomplete = false;
    glob_autocomplete = initGoogleAutoComponent($('#autocomplete')[0],glob_options,glob_autocomplete);
}

function initAutocomplete() 
{
    glob_autocomplete = false;
    glob_autocomplete = initGoogleAutoComponent($('#autocomplete')[0],glob_options,glob_autocomplete);
    // initializeMap();
}

function initGoogleAutoComponent(elem,options,autocomplete_ref)
{
    autocomplete_ref = new google.maps.places.Autocomplete(elem,options);
    autocomplete_ref = createPlaceChangeListener(autocomplete_ref,fillInAddress);
    return autocomplete_ref;
}

function createPlaceChangeListener(autocomplete_ref,fillInAddress)
{
    autocomplete_ref.addListener('place_changed', fillInAddress);
    return autocomplete_ref;
}

function destroyPlaceChangeListener(autocomplete_ref)
{
    google.maps.event.clearInstanceListeners(autocomplete_ref);
}

function fillInAddress() 
{
    // Get the place details from the autocomplete object.
    var place = glob_autocomplete.getPlace();
    for (var component in glob_component_form) 
    {
        $("#"+component).val("");
        $("#"+component).attr('disabled',false);
    }
    if(place.address_components.length > 0 )
    {
        $.each(place.address_components,function(index,elem)
        {
            var addressType = elem.types[0];
            if(glob_component_form[addressType])
            {
                var val = elem[glob_component_form[addressType]];
                $("#"+addressType).val(val) ;
            }
        });
    }

    $('#lat').val(place.geometry.location.lat());
    $('#lon').val(place.geometry.location.lng());
    $('#hide_map').remove();
    $('#address_map').show();
    /*glob_marker.setPosition(place.geometry.location);
    glob_map.setCenter(place.geometry.location);*/
}

/*function initializeMap() 
{
    var lat = $("#lat").val();
    var lon = $("#lon").val();
    if(parseFloat(lat)==0 || lat=='')
    {
        lat = 19.991043;
    }
    if(parseFloat(lon)==0 || lon =='')
    {
        lon = 73.78267;
    }
    var image = '{{url('/')}}'+'/images/front/rsz_1markbig.png';
    var latlng = new google.maps.LatLng(lat, lon);

    var myOptions = {
        zoom                      : 11,
        center                    : latlng,
        panControl                : true,
        scrollwheel               : true,
        scaleControl              : true,
        overviewMapControl        : true,
        disableDoubleClickZoom    : true,
        overviewMapControlOptions : { opened: true },
        mapTypeId                 : google.maps.MapTypeId.HYBRID
    };

    glob_map = new google.maps.Map(document.getElementById("address_map"),myOptions);
    geocoder = new google.maps.Geocoder();

    glob_marker = new google.maps.Marker({
        position: latlng,
        map: glob_map,
        icon :image,
        animation:google.maps.Animation.BOUNCE
    });

    glob_map.streetViewControl = false;
    infowindow = new google.maps.InfoWindow({
        content: "(1.10, 1.10)"
    });

    google.maps.event.addListener(glob_map, 'click', function(event) 
    {
        glob_marker.setPosition(event.latLng);
        var yeri = event.latLng;
        var latlongi = "(" + yeri.lat().toFixed(6) + ", " +yeri.lng().toFixed(6) + ")";
        infowindow.setContent(latlongi);
        document.getElementById('lat').value = yeri.lat().toFixed(6);
        document.getElementById('lon').value = yeri.lng().toFixed(6);
    });

    google.maps.event.addListener(glob_map, 'mousewheel', function(event,delta){
        console.log(delta);
    });
}*/