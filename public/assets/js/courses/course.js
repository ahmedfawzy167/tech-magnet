$(document).ready(function () {
    $('#averagePriceModal').modal('show');
});


document.addEventListener('DOMContentLoaded', () => {
    const checkAll = document.getElementById('check-all');
    const checkboxes = document.querySelectorAll('input[name="ids[]"]');
    const bulkActivateIds = document.getElementById('bulk-activate-ids');
    const bulkDeactivateIds = document.getElementById('bulk-deactivate-ids');
    const bulkDeleteIds = document.getElementById('bulk-delete-ids');

    checkAll.addEventListener('change', () => {
        checkboxes.forEach(cb => cb.checked = checkAll.checked);
    });

    const updateHiddenInputs = (hiddenInput) => {
        const selectedIds = Array.from(checkboxes)
            .filter(cb => cb.checked)
            .map(cb => cb.value);

        if (selectedIds.length === 0) {
            alert('Please select at least one course.');
            return false;
        }

        hiddenInput.value = selectedIds.join(',');
        return true;
    };

    // Handle bulk activate form submission
    document.querySelector('form[action*="bulk-activate"]').addEventListener('submit', (e) => {
        if (!updateHiddenInputs(bulkActivateIds)) {
            e.preventDefault();
        }
    });

    // Handle bulk deactivate form submission
    document.querySelector('form[action*="bulk-deactivate"]').addEventListener('submit', (e) => {
        if (!updateHiddenInputs(bulkDeactivateIds)) {
            e.preventDefault();
        }
    });

    // Handle bulk delete form submission
    document.querySelector('form[action*="bulk-destroy"]').addEventListener('submit', (e) => {
        if (!updateHiddenInputs(bulkDeleteIds)) {
            e.preventDefault();
        }
    });
});

