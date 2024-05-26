@extends('layouts.tamu', ['title' => 'Kamar'])

@section('content')


<div class="pesan">
    <form method="post" action="{{ route('tamu.insert') }}" class="row bg-white py-4 px-2 form-pesan border shadow">
        <div class="col-md">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-white border-0">Check In</span>
                </div>
                <input type="date" class="form-control rounded" placeholder="Check In" name="in">
            </div>
        </div>
        <div class="col-md">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-white border-0">Check Out</span>
                </div>
                <input type="date" class="form-control rounded" placeholder="Check Out" name="out">
            </div>
        </div>
        <div class="col-md-3">
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text bg-white border-0">Jenis Kamar</span>
                </div>
                <select name="pilihan" class="form-select form-control rounded">
                    <option value=""></option>
                    @foreach ($kamar as $k)
                    <option value="{{ $k->nama_kamar }}">{{ $k->nama_kamar }}</option>
                    @endforeach
                </select>
            </div>
        </div>
        <div class="col-md-1">
            <button type="submit" class="btn btn-block btn-info">Pesan</button>
        </div>
    </form>
</div>
<h1 class="text-center my-4">Kamar</h1>

@foreach ($kamar as $k)
<div class="card">
    <img class="card-img-top" src="/images/kamar/{{ $k->foto_kamar }}" alt="Card image cap" width="180" height="500">
    <div class="card-body">
        <h5 class="card-title"><b>{{ $k->nama_kamar }}</b></h5>
        <p class="card-text">{{ $k->deskripsi_kamar }}.</p>
        <p class="card-text"><small class="text-muted">Rp.
                {{ number_format($k->harga_kamar, 2, ',') }}</small></p>
        <p class="card-text">Kamar Tersedia: {{ $k->jum_kamar }}</p>


        @if ($k->jum_kamar > 0)
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#bookingModal" data-kamar="{{ $k }}">
            Pesan Sekarang
        </button>
        @else
        <button class="btn btn-primary" disabled>
            Kamar Penuh!
        </button>
        @endif
    </div>
</div>
@endforeach

<!-- Modal -->
<div class="modal fade" id="bookingModal" tabindex="-1" aria-labelledby="bookingModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="bookingModalLabel">Form Pemesanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form method="post" action="{{ route('tamu.insert') }}">
                    @csrf
                    <div class="mb-3">
                        <label for="checkin" class="form-label">Check In</label>
                        <input type="date" class="form-control" id="checkin" name="in">
                    </div>
                    <div class="mb-3">
                        <label for="checkout" class="form-label">Check Out</label>
                        <input type="date" class="form-control" id="checkout" name="out">
                    </div>
                    <div class="mb-3">
                        <label for="roomType" class="form-label">Jenis Kamar</label>
                        <select name="pilihan" id="roomType" class="form-select">
                            <option value=""></option>
                            @foreach ($kamar as $k)
                            @if ($k->jum_kamar > 0)
                            <option value="{{ $k->nama_kamar }}">{{ $k->nama_kamar }}</option>
                            @else
                            <option value="{{ $k->nama_kamar }}" disabled>{{ $k->nama_kamar }} (Kamar Penuh!)</option>
                            @endif
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="nama" class="form-label">Nama</label>
                        <input type="text" class="form-control" id="nama" name="nama">
                    </div>
                    <div class="mb-3">
                        <label for="No" class="form-label">No. Telepon</label>
                        <input type="text" class="form-control" id="No" name="no">
                    </div>
                    <div class="mb-3">
                        <label for="jumlah_kamar" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="jumlah_kamar" class="form-label">Jumlah Kamar</label>
                        <input type="number" class="form-control" id="jumlah_kamar" name="jumlah_kamar">
                        <div id="jumlahKamarWarning" class="text-danger" style="display: none;">Maaf, jumlah kamar yang diminta melebihi yang tersedia.</div>
                    </div>

                    <button type="submit" class="btn btn-primary">Pesan</button>
                </form>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10">
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

@endsection
<script>
    
   

document.addEventListener('DOMContentLoaded', function() {
    // Menangani alert setelah formulir dikirim
    var form = document.querySelector('form');
    
    form.addEventListener('submit', function(event) {
        // Mencegah formulir untuk dikirim secara langsung
        event.preventDefault();

        console.log('Form submitted!'); // Check if form submission event is triggered

        // Menampilkan SweetAlert
        Swal.fire({
            icon: 'success',
            title: 'Pesanan berhasil dibuat!',
            showConfirmButton: false,
            timer: 1500
        });

        console.log('SweetAlert displayed!'); // Check if SweetAlert is displayed

        // Mengosongkan nilai formulir (opsional)
        form.reset();
    });
});
</script>