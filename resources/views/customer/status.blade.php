<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Status - Halcon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white text-center">
                        <h4>Order Status</h4>
                        <p class="mb-0">Halcon Construction Materials</p>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h5>Order Information</h5>
                                <table class="table table-borderless">
                                    <tr>
                                        <th>Invoice Number:</th>
                                        <td>{{ $pedido->numeroFactura }}</td>
                                    </tr>
                                    <tr>
                                        <th>Order Date:</th>
                                        <td>{{ $pedido->fechaPedido ? $pedido->fechaPedido->format('d/m/Y') : 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Status:</th>
                                        <td>
                                            <span class="badge 
                                                @if($pedido->estadoId == 1) bg-warning
                                                @elseif($pedido->estadoId == 2) bg-info
                                                @elseif($pedido->estadoId == 3) bg-primary
                                                @elseif($pedido->estadoId == 4) bg-success
                                                @endif">
                                                {{ $pedido->status }}
                                            </span>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-6">
                                <h5>Customer Information</h5>
                                <table class="table table-borderless">
                                    <tr>
                                        <th>Customer Number:</th>
                                        <td>{{ $pedido->cliente->numeroCliente }}</td>
                                    </tr>
                                    <tr>
                                        <th>Phone:</th>
                                        <td>{{ $pedido->cliente->telefono }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        
                        @if($pedido->estadoId == 4 && $pedido->evidencias->where('tipo', 'ENTREGA')->count() > 0)
                        <div class="row">
                            <div class="col-12">
                                <h5>Delivery Evidence</h5>
                                <div class="row">
                                    @foreach($pedido->evidencias->where('tipo', 'ENTREGA') as $evidencia)
                                        <div class="col-md-6 mb-3">
                                            <div class="card">
                                                <div class="card-body">
                                                    <p>Uploaded: {{ $evidencia->fechaSubida ? $evidencia->fechaSubida->format('d/m/Y H:i') : 'N/A' }}</p>
                                                    @if($evidencia->urlFoto)
                                                        <img src="{{ asset('storage/' . $evidencia->urlFoto) }}" class="img-fluid" alt="Delivery Evidence">
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        @endif
                        
                        <div class="text-center mt-4">
                            <a href="{{ route('customer.index') }}" class="btn btn-secondary">Check Another Order</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>