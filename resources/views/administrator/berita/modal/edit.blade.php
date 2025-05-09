<div class="modal fade" id="editBeritaModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Ubah Berita</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editBeritaForm" action="#" method="POST" enctype="multipart/form-data">
          @csrf
          @method('PUT')
          <div class="row">
            <div class="col-12">
              <div class="mb-3">
                <label for="editJudul" class="form-label">Judul Berita</label>
                <input type="text" name="judul" id="editJudul" class="form-control" placeholder="Masukkan judul.." required>
              </div>
            </div>
            <div class="col-12">
              <div class="mb-3">
                <label for="editIsi" class="form-label">Isi Berita</label>
                <textarea name="isi" id="editIsi" class="form-control" placeholder="Masukkan isi.." rows="3" required></textarea>
              </div>
            </div>
            <div class="col-12">
              <div class="mb-3">
                <label for="editPenulis" class="form-label">Penulis</label>
                <input type="text" name="penulis" id="editPenulis" class="form-control" placeholder="Masukkan penulis.." required>
              </div>
            </div>
            <div class="col-12">
              <div class="mb-3">
                <label for="editKategoriId" class="form-label">Kategori</label>
                <select name="kategori_id" id="editKategoriId" class="form-select">
                  <option value="">Pilih Kategori</option>
                  @foreach ($kategoris as $kategori)
                  <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                  @endforeach
                </select>
              </div>
            </div>
            <div class="col-12">
              <div class="mb-3">
                <label for="editGambar" class="form-label">Gambar</label>
                <input type="file" name="gambar" id="editGambar" class="form-control">
              </div>
              <div class="mb-3">
                <img id="currentGambar" src="" alt="Gambar Berita" width="100">
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary close-button" data-bs-dismiss="modal">Tutup</button>
            <button type="submit" class="btn btn-success">Ubah</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
