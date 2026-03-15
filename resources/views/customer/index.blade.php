<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Check Order Status - Halcon</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card shadow">
                    <div class="card-header bg-primary text-white text-center">
                        <h4>Check Order Status</h4>
                        <p class="mb-0">Halcon Construction Materials</p>
                    </div>
                    <div class="card-body">
                        @if(session('errors'))
                            <div class="alert alert-danger">
                                <ul class="mb-0">
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{ route('customer.checkStatus') }}" method="POST">
                            @csrf
                            
                            <div class="mb-3">
                                <label for="numeroCliente" class="form-label">Customer Number</label>
                                <input type="text" class="form-control @error('numeroCliente') is-invalid @enderror" id="numeroCliente" name="numeroCliente" value="{{ old('numeroCliente') }}" required>
                            </div>
                            
                            <div class="mb-3">
                                <label for="numeroFactura" class="form-label">Invoice Number</label>
                                <input type="text" class="form-control @error('numeroFactura') is-invalid @enderror" id="numeroFactura" name="numeroFactura" value="{{ old('numeroFactura') }}" required>
                            </div>
                            
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary">Check Status</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>