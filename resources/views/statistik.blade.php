@extends('layouts.app')

@section('content')
<div class="container">
    <h2 class="text-center mb-4">Statistik Status Pengajuan SPPG</h2>

    <div class="row justify-content-center mb-4">
        <div class="col-md-6">
            <canvas id="chartStatus"></canvas>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <h4 class="mb-3">Jumlah per Provinsi</h4>
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>Provinsi</th>
                        <th>Total SPPG</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($perProvinsi as $prov)
                        <tr>
                            <td>{{ $prov['provinsi'] }}</td>
                            <td>{{ $prov['total'] }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Chart.js -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    var ctx = document.getElementById('chartStatus').getContext('2d');
    var chart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ['Beroperasi', 'Belum Beroperasi'],
            datasets: [{
                data: [{{ $beroperasi }}, {{ $belum }}],
                backgroundColor: [
                    'rgba(40, 167, 69, 0.7)', // hijau
                    'rgba(220, 53, 69, 0.7)'  // merah
                ],
                borderColor: [
                    'rgba(40, 167, 69, 1)',
                    'rgba(220, 53, 69, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    position: 'bottom'
                }
            }
        }
    });
</script>
@endsection
