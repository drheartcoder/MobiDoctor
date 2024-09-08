<script src="{{ url('/') }}/public/front/js/autocomplete.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?v=3&key={{ trim( env('GOOGLE_MAPS_API') ) }}&libraries=places&callback=initAutocomplete"
async defer>
</script>