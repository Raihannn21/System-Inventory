<script>
  $(function () {
    $('#createKategoriModal').on('shown.bs.modal', () => {
      $('#createKategoriModal').find('input').not('[type=hidden]')[0].focus();
    });

    $('#editKategoriModal').on('shown.bs.modal', () => {
      $('#editKategoriModal').find('input').not('[type=hidden]')[0].focus();
    });

    $('.datatable').on('click', '.editKategoriButton', function (e) {
      let id = $(this).data('id');
      let showURL = "{{ route('api.v1.kategoris.show', 'param') }}";
      let updateURL = "{{ route('administrators.kategoris.update', 'param') }}";
      showURL = showURL.replace('param', id);
      updateURL = updateURL.replace('param', id);

      let input = $('#editKategoriModal :input').not('[type=hidden]').not('.btn-close').not('.close-button').not('[type=submit]');
      input.val('Sedang mengambil data..');
      input.attr('disabled', true);

      $.ajax({
        url: showURL,
        method: 'GET',
        success: (res) => {
          input.attr('disabled', false);
          $('#editKategoriModal #nama').val(res.data.nama); // Pastikan ID input sesuai dengan yang ada di modal
          $('#editKategoriModal form').attr('action', updateURL);
        },
        error: (err) => {
          Swal.fire(
            'Error',
            'Terjadi kesalahan, laporkan kepada administrator!',
            'error'
          );

          $('#editKategoriModal').on('shown.bs.modal', () => {
            $('#editKategoriModal').modal('hide');
          });
        }
      });
    });
  });
</script>
