function updateStatus(element, operationId) {
    const form = document.getElementById(`status-form-${operationId}`);
    const checkbox = element.checked;
    const status = checkbox ? 'active' : 'inactive';

    form.querySelector('input[name="status"]').value = status;

    form.submit();
}