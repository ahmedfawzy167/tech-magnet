function updateStatus(element, studentId) {
    const form = document.getElementById(`status-form-${studentId}`);
    const checkbox = element.checked;
    const status = checkbox ? 'active' : 'inactive';

    form.querySelector('input[name="status"]').value = status;

    form.submit();
}
