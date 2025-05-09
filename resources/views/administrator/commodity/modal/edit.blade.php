<div class="modal fade" id="editCommodityModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Ubah Barang</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="#" method="POST">
          @csrf
          @method('PUT')
          <div class="row">
            <div class="col-12">
              <div class="mb-3">
                <label for="name" class="form-label">Kode Barang</label>
                <input type="name" name="commodity_code" id="name" class="form-control" placeholder="Masukkan kode barang..">
              </div>
            </div>
          </div>
          <div class="row">
            <div class="col-12">
              <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="name" name="name" id="name" class="form-control" placeholder="Masukkan nama..">
              </div>
            </div>
          </div>
          <div class="mb-3">
            <label for="name" class="form-label">Stok Barang</label>
            <input type="number" name="quantity" id="name"
              class="form-control @error('quantity', 'store') is-invalid @enderror" @if($errors->hasBag('store'))
            value="{{ old('quantity') }}" @endif placeholder="Masukkan Jumlah Stok.."
            required>
            @error('quantity', 'store')
            <div class="d-block invalid-feedback">
              {{ $message }}
            </div>
            @enderror
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
