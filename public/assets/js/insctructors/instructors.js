function updateStatus(element, instructorId) {
    const form = document.getElementById(`status-form-${instructorId}`);
    const checkbox = element.checked;
    const status = checkbox ? 'active' : 'inactive';

    form.querySelector('input[name="status"]').value = status;

    form.submit();
}