$(document).ready(function () {
    $('#averagePriceModal').modal('show');
});


document.getElementById('check-all').addEventListener('change', function () {
    const checkboxes = document.querySelectorAll('input[name="ids[]"]');
    checkboxes.forEach(checkbox => {
        checkbox.checked = this.checked;
    });
});

