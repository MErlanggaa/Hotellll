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
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
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
                        <select name="pilihan" id="roomType" class="form-control">
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

@if($modal)
<!-- Modal Baru -->
<div class="modal fade" id="infoModal" tabindex="-1" aria-labelledby="infoModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="infoModalLabel">Informasi Pemesanan</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">x</button>
            </div>
            <div class="modal-body" id="printableArea">
                <p><strong>Check In:</strong> <span id="infoCheckin">{{$data->checkin}}</span></p>
                <p><strong>Check Out:</strong> <span id="infoCheckout">{{$data->checkout}}</span></p>
                <p><strong>Jenis Kamar:</strong> <span id="infoRoomType">{{$data->jenis}}</span></p>
                <p><strong>Nama:</strong> <span id="infoNama">{{$data->nama}}</span></p>
                <p><strong>No. Telepon:</strong> <span id="infoNo">{{$data->no}}</span></p>
                <p><strong>Email:</strong> <span id="infoEmail">{{$data->email}}</span></p>
                <p><strong>Jumlah Kamar:</strong> <span id="infoJumlahKamar">{{$data->jumlah_kamar}}</span></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">OK</button>
                <button type="button" class="btn btn-primary" onclick="printModal()">Cetak</button>
            </div>
        </div>
    </div>
</div>
@endif
@endsection
   <!-- Include the SweetAlert2 stylesheet -->
   <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.css">

   <!-- Include the SweetAlert2 JavaScript -->
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10/dist/sweetalert2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>


@if($modal)
<script type="text/javascript">
     window.onload = function() {
         OpenBootstrapPopup();
        };
        function OpenBootstrapPopup() {
            $("#infoModal").modal('show');
            }
</script>
@endif

<script>
// document.addEventListener('DOMContentLoaded', function() {
//     var form = document.querySelector('form');

//     document.querySelector('button[type="submit"]').addEventListener('click', function(event) {
//         event.preventDefault();
        
//         let checkin = document.getElementById('checkin').value;
//         let checkout = document.getElementById('checkout').value;
//         let roomType = document.getElementById('roomType').value;
//         let nama = document.getElementById('nama').value;
//         let no = document.getElementById('No').value;
//         let email = document.getElementById('email').value;
//         let jumlah_kamar = document.getElementById('jumlah_kamar').value;

//         console.log('Data yang akan dikirim:', {checkin, checkout, roomType, nama, no, email, jumlah_kamar});

//         let data = {
//             checkin: checkin,
//             checkout: checkout,
//             roomType: roomType,
//             nama: nama,
//             no: no,
//             email: email,
//             jumlah_kamar: jumlah_kamar,
//             _token: '{{ csrf_token() }}'
//         };
        
//         fetch('{{ route("pesan.info") }}', {
//             method: 'POST',
//             headers: {
//                 'Content-Type': 'application/json'
//             },
//             body: JSON.stringify(data)
//         })
//         .then(response => {
//             if (!response.ok) {
//                 throw new Error('Network response was not ok');
//             }
//             return response.json();
//         })
//         .then(data => {
//             console.log('Data diterima dari server:', data);
//             document.getElementById('infoCheckin').innerText = data.checkin;
//             document.getElementById('infoCheckout').innerText = data.checkout;
//             document.getElementById('infoRoomType').innerText = data.roomType;
//             document.getElementById('infoNama').innerText = data.nama;
//             document.getElementById('infoNo').innerText = data.no;
//             document.getElementById('infoEmail').innerText = data.email;
//             document.getElementById('infoJumlahKamar').innerText = data.jumlah_kamar;
            
//             new bootstrap.Modal(document.getElementById('infoModal')).show();
//         })
//         .catch(error => {
//             console.error('Error:', error);
//             Swal.fire({
//                 icon: 'error',
//                 title: 'Gagal membuat pesanan!',
//                 text: 'Silakan coba lagi.'
//             });
//         });

        Swal.fire({
            icon: 'success',
            title: 'Pesanan berhasil dibuat!',
            showConfirmButton: false,
            timer: 1500
        });

        form.reset();
//     });
// });
</script>
<script>
function printModal() {
    var logo = '<img src="../img/public/logo.png" style="width:100px; display: block; margin: 0 auto;">'; // Sesuaikan path dan ukuran logo
    var namaHotel = '<h1 style="text-align: center; margin-top: 20px;">Hotel Skibidi</h1>'; // Ganti "Nama Hotel" dengan nama hotel yang sesuai

    var printContents = document.getElementById('printableArea').innerHTML;
    var originalContents = document.body.innerHTML;

    // Menambahkan logo dan nama hotel ke konten yang akan dicetak
    document.body.innerHTML = '<div style="text-align: center;">' + logo + namaHotel + '</div>' + printContents;
    window.print();
    document.body.innerHTML = originalContents;

    // Setelah cetak, kembalikan tampilan halaman seperti semula
    window.location.reload();
}
</script>
 