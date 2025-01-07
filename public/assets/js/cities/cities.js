$(document).ready(function () {
    // Add City
    $('#addCityBtn').on('click', function () {
        $('#addCityModal').modal('show');
    });

    // Edit City
    $('.btn-edit').on('click', function () {
        const cityId = $(this).data('id');
        const cityName = $(this).data('name');

        $('#updateCityId').val(cityId);
        $('#updateCityName').val(cityName);
        $('#updateCityForm').attr('action', '/admin/cities/' + cityId);

    });
});
