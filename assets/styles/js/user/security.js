import $ from 'jquery';

$(document).ready(function() {
    function handleForm(formId, apiUrl, fields) {
        $(formId).on('submit', function(e) {
            e.preventDefault();

            const data = {};
            fields.forEach(field => {
                data[field] = $(`${formId} [name$="[${field}]"]`).val();
            });

            $.ajax({
                url: apiUrl,
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                data: JSON.stringify(data),
                xhrFields: { withCredentials: true },
                success: function () {
                    $(`${formId} ~ #result`).text('Opération réussie !');
                },
                error: function () {
                    $(`${formId} ~ #result`).text('Une erreur est survenue');
                }
            });
        });
    }

    handleForm('#login-form', 'https://silversat-api.silversat.ovh/api/login', ['email', 'password']);
    handleForm('#register-form', 'https://silversat-api.silversat.ovh/api/register', ['username', 'email', 'password']);
})