import $ from 'jquery';

$(document).ready(function() {
    $.ajax({
        url: 'https://silversat-api.silversat.ovh/api/logout',
        method: 'POST',
        xhrFields: { withCredentials: true },
    }).always(function() {
        window.location.href = "/login";
    })
})