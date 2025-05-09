<script>
  $(function () {
    $('#createBeritaModal').on('shown.bs.modal', () => {
      $('#createBeritaModal').find('input').not('[type=hidden]')[0].focus();
    });

    $('#editBeritaModal').on('shown.bs.modal', () => {
      $('#editBeritaModal').find('input').not('[type=hidden]')[0].focus();
    });

    $('.datatable').on('click', '.editBeritaButton', function (e) {
      let id = $(this).data('id');
      let showURL = "{{ route('api.v1.beritas.show', 'param') }}";
      let updateURL = "{{ route('administrators.beritas.update', 'param') }}";
      showURL = showURL.replace('param', id);
      updateURL = updateURL.replace('param', id);

      let input = $('#editBeritaModal :input').not('[type=hidden]').not('.btn-close').not('.close-button').not('[type=submit]');
      input.val('Sedang mengambil data..');
      input.attr('disabled', true);

      $.ajax({
        url: showURL,
        method: 'GET',
        success: (res) => {
          input.attr('disabled', false);
          $('#editBeritaModal #judul').val(res.data.judul);
          $('#editBeritaModal #isi').val(res.data.isi);
          $('#editBeritaModal #penulis').val(res.data.penulis);
          $('#editBeritaModal #kategori_id').val(res.data.kategori_id);
          // Update gambar hanya jika ada
          if (res.data.gambar) {
            $('#editBeritaModal #currentImage').attr('src', res.data.gambar).show();
          } else {
            $('#editBeritaModal #currentImage').hide();
          }
          $('#editBeritaModal form').attr('action', updateURL);
        },
        error: (err) => {
          Swal.fire(
            'Error',
            'Terjadi kesalahan, laporkan kepada administrator!',
            'error'
          );

          $('#editBeritaModal').on('shown.bs.modal', () => {
            $('#editBeritaModal').modal('hide');
          });
        }
      });
    });
  });
</script>
