@extends('layouts.admin', ['title' => 'Dashboard'])

@section('content-header')
<h1 class="m-0">Dashboard</h1>
@endsection

@section('content')

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <div class="content-wrapper">
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">DATA  CHEKOUT KAMAR</h3>
                                </div>
                                <div class="card-body">
                                    <div class="chart">
                                        <canvas id="lineChartCheckout"
                                            style="min-height: 500px; height: 500px; max-height: 500px; max-width: 100%;"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card card-info">
                                <div class="card-header">
                                    <h3 class="card-title">DATA CHEKIN KAMAR</h3>
                                </div>
                                <div class="card-body">
                                    <div class="chart">
                                        <canvas id="lineChartCheckin"
                                            style="min-height: 500px; height: 500px; max-height: 500px; max-width: 100%;"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        var persentaseKehadiran = {!! $bulan !!};

        var dataCheckout = {
            labels: persentaseKehadiran,
            datasets: [{
                label: 'Total Checkout',
                data: {!! $checkout !!},
                borderColor: 'hsl(89, 43%, 51%)',

            }]
        };

        var dataCheckin = {
            labels: persentaseKehadiran,
            datasets: [{
                label: 'Total Checkin',
                data: {!! $checkin !!},
                borderColor: 'rgb(201, 76, 76)',

            }]
        };

        // Inisialisasi grafik Checkout
        var ctxCheckout = document.getElementById('lineChartCheckout').getContext('2d');
        var myLineChartCheckout = new Chart(ctxCheckout, {
            type: 'line',
            data: dataCheckout
        });

        // Inisialisasi grafik Checkin
        var ctxCheckin = document.getElementById('lineChartCheckin').getContext('2d');
        var myLineChartCheckin = new Chart(ctxCheckin, {
            type: 'line',
            data: dataCheckin
        });
    </script>
</body>

@endsection
