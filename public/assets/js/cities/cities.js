$(document).ready(function () {
    let table = $('#data-table').DataTable();
    // Add City
    $('#addCityBtn').on('click', function () {
        $('#addCityModal').modal('show');
    });

    // Edit City
    $('#data-table tbody').on('click', '.btn-edit', function () {
        const cityId = $(this).data('id');
        const cityName = $(this).data('name');
        const countryId = $(this).data('country-id');

        $('#updateCityId').val(cityId);
        $('#updateCityName').val(cityName);
        $('#updateCountryId').val(countryId).change();
        $('#updateCityForm').attr('action', '/admin/cities/' + cityId);

    });
});
