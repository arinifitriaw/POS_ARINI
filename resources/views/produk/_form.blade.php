@csrf

<div class="row">

    <div class="col-md-4 text-center mb-4">

        @if (!empty($produk->foto))

            <label class="fw-bold mb-2">Foto Saat Ini</label>

            <img src="{{ asset('storage/' . $produk->foto) }}"
                class="img-thumbnail shadow rounded mb-3"
                style="width:220px;height:220px;object-fit:cover;">

        @endif

        <label class="fw-bold">Preview Foto</label>

        <img id="preview"
            class="img-thumbnail shadow mt-2"
            style="display:none;width:220px;height:220px;object-fit:cover;">

    </div>

    <div class="col-md-8">

        <div class="mb-3">

            <label class="form-label fw-bold">
                Upload Foto
            </label>

            <input
                type="file"
                name="foto"
                onchange="previewImage(this)"
                class="form-control @error('foto') is-invalid @enderror">

            @error('foto')
                <div class="invalid-feedback d-block">
                    {{ $message }}
                </div>
            @enderror

        </div>

        <div class="mb-3">

            <label class="form-label fw-bold">
                Nama Produk
            </label>

            <input
                type="text"
                name="name"
                value="{{ old('name', $produk->nama ?? '') }}"
                class="form-control @error('name') is-invalid @enderror">

            @error('name')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

        </div>

        <div class="mb-3">

            <label class="form-label fw-bold">
                Harga Beli
            </label>

            <input
                type="number"
                name="purchase_price"
                value="{{ old('purchase_price', $produk->harga_beli ?? '') }}"
                class="form-control @error('purchase_price') is-invalid @enderror">

            @error('purchase_price')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

        </div>

        <div class="mb-3">

            <label class="form-label fw-bold">
                Harga Jual
            </label>

            <input
                type="number"
                name="selling_price"
                value="{{ old('selling_price', $produk->harga_jual ?? '') }}"
                class="form-control @error('selling_price') is-invalid @enderror">

            @error('selling_price')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

        </div>

        <div class="mb-4">

            <label class="form-label fw-bold">
                Stok Produk
            </label>

            <input
                type="number"
                name="stock"
                value="{{ old('stock', $produk->stok ?? '') }}"
                class="form-control @error('stock') is-invalid @enderror">

            @error('stock')
                <div class="invalid-feedback">
                    {{ $message }}
                </div>
            @enderror

        </div>

        <div class="d-flex gap-2">

            <button
                class="btn btn-success rounded-pill px-4"
                type="submit">

                Update Product

            </button>

            <a href="{{ route('produk.index') }}"
                class="btn btn-secondary rounded-pill px-4">

                Batal

            </a>

        </div>

    </div>

</div>

<script>

function previewImage(input){

    const preview=document.getElementById('preview');

    const file=input.files[0];

    if(file){

        preview.src=URL.createObjectURL(file);

        preview.style.display='block';

    }

}

</script>