@csrf

<div class="card shadow border-0 rounded-4">
    <!-- <div class="card-header bg-primary text-white rounded-top-4">
        <h4 class="mb-0">✏️ Edit User</h4>
    </div> -->

    <div class="card-body p-4">

        <div class="mb-3">
            <label class="form-label fw-bold">Nama</label>
            <input type="text" name="name"
                class="form-control rounded-3 @error('name') is-invalid @enderror"
                value="{{ old('name', $user->name ?? '') }}">
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Email</label>
            <input type="email" name="email"
                class="form-control rounded-3 @error('email') is-invalid @enderror"
                value="{{ old('email', $user->email ?? '') }}">
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label fw-bold">Password</label>
            <input type="password" name="password"
                class="form-control rounded-3 @error('password') is-invalid @enderror"
                placeholder="Kosongkan jika tidak diubah">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-4">
            <label class="form-label fw-bold">Role</label>
            <select name="role_id"
                class="form-select rounded-3 @error('role_id') is-invalid @enderror">
                <option value="">-- Pilih Role --</option>

                @foreach($roles as $role)
                    <option value="{{ $role->id }}"
                        @selected(old('role_id', $user->role_id ?? '') == $role->id)>
                        {{ ucfirst($role->name) }}
                    </option>
                @endforeach
            </select>

            @error('role_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="d-flex gap-2">
            <button class="btn btn-success px-4">
                💾 Simpan
            </button>

            <a href="{{ route('admin.users') }}" class="btn btn-secondary px-4">
                ← Kembali
            </a>
        </div>

    </div>
</div>