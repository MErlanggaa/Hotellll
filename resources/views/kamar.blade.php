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
            <img class="card-img-top" src="/images/kamar/{{ $k->foto_kamar }}" alt="Card image cap" width="180"
                height="500">
            <div class="card-body">
                <h5 class="card-title"><b>{{ $k->nama_kamar }}</b></h5>
                <p class="card-text">{{ $k->deskripsi_kamar }}.</p>
                <p class="card-text"><small class="text-muted">Rp.
                        {{ number_format($k->harga_kamar, 2, ',') }}</small></p>
                <button class="btn btn-primary" onclick="scrollToTop()">Pesan Sekarang</button>
            </div>
        </div>
    @endforeach

    <script>
        function scrollToTop() {
            var topElements = document.getElementsByClassName('pesan');
            if (topElements.length > 0) {
                topElements[0].scrollIntoView({
                    behavior: 'smooth',
                    block: 'start'
                });
            }
        }
    </script>
@endsection
