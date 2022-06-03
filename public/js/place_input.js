// GOOGLE
let autocomplete,
    address1Field,
    address2Field,
    postalField;
let componentForm = {
    street_number: 'short_name',
    route: 'long_name',
    locality: 'long_name',
    administrative_area_level_1: 'short_name',
    country: 'long_name',
    postal_code: 'short_name'
};
addressField = document.getElementById("address");
function initMap() {
    address1Field = document.querySelector("#ship-address");
    address2Field = document.querySelector("#place-address");
    autocomplete = new google.maps.places.Autocomplete(address1Field, {
        componentRestrictions: { country: ["by","ru"] },
        fields: ["address_components", "geometry"],
        types: ["geocode"],
    });
    google.maps.event.addListener(autocomplete, 'place_changed', function() {
        fillInAddress();
    });
}
function callback(results, status) {
    if (status === google.maps.places.PlacesServiceStatus.OK) {
        for (let i = 0; i < results.length; i++) {
            let option =  document.createElement(
                'OPTION'
            );
            option.value=results[i].name;
            option.innerText=results[i].name;
            address2Field.appendChild(option);
        }
    }
}
function fillInAddress() {
    let place = autocomplete.getPlace();
    let location = place.geometry.location;
    let place_id = place.place_id;

    for (let i = 0; i < place.address_components.length; i++) {
        let addressType = place.address_components[i].types[0];
        console.log(addressType)
        if (componentForm[addressType]) {
            let val = place.address_components[i][componentForm[addressType]];
            if(document.getElementById(addressType)) {
                document.getElementById(addressType).value = (val);
            }
        }
    }
}
