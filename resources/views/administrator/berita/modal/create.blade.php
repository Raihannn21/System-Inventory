<div class="modal fade" id="createBeritaModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Tambah Berita</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('administrators.beritas.store') }}" method="POST" enctype="multipart/form-data">
          @csrf
          <div class="row">
            <div class="col-12">
              <div class="mb-3">
                <label for="judul" class="form-label">Judul Berita</label>
                <input type="text" name="judul" id="judul"
                  class="form-control @error('judul', 'store') is-invalid @enderror"
                  value="{{ old('judul') }}" placeholder="Masukkan judul berita.." required>
                @error('judul', 'store')
                <div class="d-block invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
            <div class="col-12">
              <div class="mb-3">
                <label for="isi" class="form-label">Isi Berita</label>
                <textarea name="isi" id="isi"
                  class="form-control @error('isi', 'store') is-invalid @enderror"
                  placeholder="Masukkan isi berita.." required>{{ old('isi') }}</textarea>
                @error('isi', 'store')
                <div class="d-block invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
            <div class="col-12">
              <div class="mb-3">
                <label for="penulis" class="form-label">Penulis</label>
                <input type="text" name="penulis" id="penulis"
                  class="form-control @error('penulis', 'store') is-invalid @enderror"
                  value="{{ old('penulis') }}" placeholder="Masukkan nama penulis.." required>
                @error('penulis', 'store')
                <div class="d-block invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
            <div class="col-12">
              <div class="mb-3">
                <label for="kategori_id" class="form-label">Kategori</label>
                <select name="kategori_id" id="kategori_id"
                  class="form-select @error('kategori_id', 'store') is-invalid @enderror">
                  <option value="">Pilih Kategori</option>
                  @foreach ($kategoris as $kategori)
                  <option value="{{ $kategori->id }}">{{ $kategori->nama }}</option>
                  @endforeach
                </select>
                @error('kategori_id', 'store')
                <div class="d-block invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
            </div>
            <div class="col-12">
              <div class="mb-3">
                <label for="gambar" class="form-label">Gambar</label>
                <input type="file" name="gambar" id="gambar"
                  class="form-control @error('gambar', 'store') is-invalid @enderror">
                @error('gambar', 'store')
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
