<div class="modal fade" id="createCommodityModal" tabindex="-1" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5">Tambah Barang</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{ route('administrators.commodities.store') }}" method="POST">
          @csrf
          <div class="row">
            <div class="col-12">
              <div class="mb-3">
                <label for="name" class="form-label">Kode Barang</label>
                <input type="name" name="commodity_code" id="name"
                  class="form-control @error('commodity_code', 'store') is-invalid @enderror" @if($errors->hasBag('store'))
                value="{{ old('commodity_code') }}" @endif placeholder="Masukkan Kode Barang.."
                required>
                @error('', 'store')
                <div class="d-block invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
              <div class="mb-3">
                <label for="name" class="form-label">Nama</label>
                <input type="name" name="name" id="name"
                  class="form-control @error('name', 'store') is-invalid @enderror" @if($errors->hasBag('store'))
                value="{{ old('name') }}" @endif placeholder="Masukkan nama.."
                required>
                @error('name', 'store')
                <div class="d-block invalid-feedback">
                  {{ $message }}
                </div>
                @enderror
              </div>
              <div class="mb-3">
                <label for="name" class="form-label">Stok Barang</label>
                <input type="name" name="stock" id="name"
                  class="form-control @error('stock', 'store') is-invalid @enderror" @if($errors->hasBag('store'))
                value="{{ old('stock') }}" @endif placeholder="Masukkan Jumlah Stok.."
                required>
                @error('stock', 'store')
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
