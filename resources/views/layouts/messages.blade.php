<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

@if(session('message'))
     <script>
        Swal.fire({
        title: "Message",
        text: "{{ session('message') }}",
        icon: "success",
        showCancelButton: false,
        confirmButtonText: "OK",
        timer: 3000,
      });
    </script>
@endif
