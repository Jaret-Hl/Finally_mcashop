@extends('layouts.app')


@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css">
@endsection

@section('title', 'Clientes')

@section('content')
    <nav class="navbar">
        <div class="container">
            <a class="navbar-brand">
                Header
            </a>
        </div>
    </nav>
    <div class="container">
        <h1 class="text-center mt-2"> Estado de proveedor</h1>
        <hr>
        <div class="row col-6">
            
            
                <canvas id="myChart"></canvas>
              


        </div>
    </div>
@stop
@section('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.2.1/dist/chart.umd.min.js"></script>
    <script>
        const ctx = document.getElementById('myChart');

new Chart(ctx, {
  type: 'bar',
  data: {
    labels: ['Red', 'Orange', 'Yellow', 'Green', 'Blue', 'Purple'],
    datasets: [{
      label: '# Compras a proveedores',
      data: [12, 19, 3, 5, 2, 3],
      borderWidth: 1,
      backgroundColor: [
      'rgba(255, 99, 132, 0.2)',
      'rgba(255, 159, 64, 0.2)',
      'rgba(255, 205, 86, 0.2)',
      'rgba(75, 192, 192, 0.2)',
      'rgba(54, 162, 235, 0.2)',
      'rgba(153, 102, 255, 0.2)',
      
    ],
    borderColor: [
      'rgb(255, 99, 132)',
      'rgb(255, 159, 64)',
      'rgb(255, 205, 86)',
      'rgb(75, 192, 192)',
      'rgb(54, 162, 235)',
      'rgb(153, 102, 255)',
      
    ],
    }]
  },
  options: {
    scales: {
      y: {
        beginAtZero: true
      }
    }
  }
});
    </script>

@endsection
