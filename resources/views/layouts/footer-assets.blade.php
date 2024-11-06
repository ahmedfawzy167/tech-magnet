@vite('resources/js/app.js')
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.5.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.datatables.net/2.0.7/js/dataTables.min.js"></script>
<script src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.colVis.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.print.min.js"></script>
<script src="https://cdn.datatables.net/buttons/3.0.2/js/buttons.html5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/fixedcolumns/5.0.0/js/dataTables.fixedColumns.min.js"></script>
<script src="https://cdn.datatables.net/fixedcolumns/5.0.0/js/fixedColumns.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/keytable/2.12.0/js/dataTables.keyTable.min.js"></script>
<script src="https://cdn.datatables.net/keytable/2.12.0/js/keyTable.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/rowreorder/1.5.0/js/dataTables.rowReorder.min.js"></script>
<script src="https://cdn.datatables.net/rowreorder/1.5.0/js/rowReorder.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/searchbuilder/1.7.1/js/dataTables.searchBuilder.min.js"></script>
<script src="https://cdn.datatables.net/searchbuilder/1.7.1/js/searchBuilder.bootstrap5.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<!-- Toastr Notification JS -->

<script>
  toastr.options = {
 "closeButton": false,
 "debug": false,
 "preventDuplicates": false,
 "onclick": null,
 "showDuration": "500",
 "hideDuration": "1000",
 "timeOut": "5000",
 "extendedTimeOut": "1000",
 "showEasing": "swing",
 "hideEasing": "linear",
 "showMethod": "fadeIn",
 "hideMethod": "fadeOut",
 "toastClass": "bg-success text-white"
}
</script>
@if(session('message'))
     <script>
       toastr.success("{{ session('message') }}");
   </script>
@endif


<script>
  toastr.options = {
 "closeButton": false,
 "debug": false,
 "preventDuplicates": false,
 "onclick": null,
 "showDuration": "500",
 "hideDuration": "1000",
 "timeOut": "5000",
 "extendedTimeOut": "1000",
 "showEasing": "swing",
 "hideEasing": "linear",
 "showMethod": "fadeIn",
 "hideMethod": "fadeOut",
 "toastClass": "bg-danger text-white"
}
</script>


@if ($errors->any())
 @foreach ($errors->all() as $error)
   <script>
       toastr.error('{{ $error }}');
   </script>
 @endforeach

@endif



<script>
$(document).ready(function() {
 $('#data-table').DataTable();
});
</script>

<script>
$(document).ready(function() {
    $('#summernote').summernote();
});
</script>


 <!-- SweetAlert2 JS -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
      // Capture the Delete Button click event

      document.querySelectorAll('.btn-delete').forEach(button => {
            button.addEventListener('click', function() {
                var url = this.dataset.url;

                // Trigger SweetAlert confirmation
                Swal.fire({
                    title: 'Are you Sure?',
                    text: "You Will be Able to Restore it Later! 😎",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Trash it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Create and submit the form
                        var form = document.createElement('form');
                        form.method = 'POST';
                        form.action = url;

                        var tokenInput = document.createElement('input');
                        tokenInput.type = 'hidden';
                        tokenInput.name = '_token';
                        tokenInput.value = '{{ csrf_token() }}';
                        form.appendChild(tokenInput);

                        var methodInput = document.createElement('input');
                        methodInput.type = 'hidden';
                        methodInput.name = '_method';
                        methodInput.value = 'DELETE';
                        form.appendChild(methodInput);

                        document.body.appendChild(form);
                        form.submit();
                    }
                });
            });
        });
    });




     // Capture the Delete Forever button click event

      document.querySelectorAll('.btn-delete-forever').forEach(button => {
          button.addEventListener('click', function(event) {
              event.preventDefault(); // Prevent default anchor behavior
              var url = this.dataset.url;

              // Trigger SweetAlert confirmation
              Swal.fire({
                  title: 'Are you sure?',
                  text: "You Won't be Able to Restore it! 🤷‍♂️",
                  icon: 'warning',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Yes, Delete it!'
              }).then((result) => {
                  if (result.isConfirmed) {
                      // Create and submit the form
                      var form = document.createElement('form');
                      form.method = 'POST';
                      form.action = url;

                      var tokenInput = document.createElement('input');
                      tokenInput.type = 'hidden';
                      tokenInput.name = '_token';
                      tokenInput.value = '{{ csrf_token() }}';
                      form.appendChild(tokenInput);

                      var methodInput = document.createElement('input');
                      methodInput.type = 'hidden';
                      methodInput.name = '_method';
                      methodInput.value = 'DELETE';
                      form.appendChild(methodInput);

                      document.body.appendChild(form);
                      form.submit(); // Submit the form only after confirmation
                  }
              });
          });
      });
</script>



        
<!-- Bootstrap core JavaScript-->
<script src="{{ asset('assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('assets/js/sb-admin-2.min.js') }}"></script>

<!-- Page level plugins -->
<script src="{{ asset('assets/vendor/chart.js/Chart.min.js') }}"></script>