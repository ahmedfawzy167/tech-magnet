$(document).ready(function () {
    // Add Location
    $('#addLocationModal').on('click', function () {
        $('#addLocationModal').modal('show');
    });

    // Edit Location
    $('.btn-edit').on('click', function () {
        const locationId = $(this).data('id');
        const locationName = $(this).data('name');

        $('#updateLocationId').val(locationId);
        $('#updateLocationName').val(locationName);
        $('#updateLocationForm').attr('action', '/admin/locations/' + locationId);

    });
});
