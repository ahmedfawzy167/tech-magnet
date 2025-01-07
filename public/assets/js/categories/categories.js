$(document).ready(function () {
    // Add Category
    $('#addCategoryBtn').on('click', function () {
        $('#addCategoryModal').modal('show');
    });

    // Edit Category
    $('.btn-edit').on('click', function () {
        const categoryId = $(this).data('id');
        const categoryName = $(this).data('name');

        $('#updateCategoryId').val(categoryId);
        $('#updateCategoryName').val(categoryName);
        $('#updateCategoryForm').attr('action', '/admin/categories/' + categoryId);

    });
});
