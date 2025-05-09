<div class="modal fade" id="createKategoriModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Tambah Kategori Berita</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('administrators.kategoris.store') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-12">
              <div class="mb-3">
                <label for="nama" class="form-label">Nama Kategori</label>
                <input type="text" name="nama" id="nama"
                  class="form-control @error('nama', 'store') is-invalid @enderror"
                  value="{{ old('nama') }}" placeholder="Masukkan nama kategori.." required>
                @error('nama', 'store')
                <div class="d-block invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary close-button" data-bs-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-success">Tambah</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
