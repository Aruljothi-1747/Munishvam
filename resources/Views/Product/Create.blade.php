@extends('adminLTE.AdminLTE_Layout')
@section('Tittle')
Create Product
@endsection

<!--Main Content-->
@section('maincontent')
<div class="container-fluid">
    <div class="row justify-content-start">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-default text-black">Add Product</div>

                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ route('product.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="ProductName">ProductName</label>
                                    <input type="text" class="form-control" id="ProductName" name="ProductName"
                                        value="{{ old('ProductName') }}" required>
                                    @error('ProductName')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="ProductPrice">ProductPrice</label>
                                    <input type="Number" class="form-control" id="ProductPrice" name="ProductPrice"
                                        value="{{ old('ProductPrice') }}">
                                    @error('ProductPrice')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="ProductType">ProductType</label>
                                    <input type="text" class="form-control" id="ProductType" name="ProductType"
                                        value="{{ old('ProductType') }}" required>
                                    @error('ProductType')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="ProductDescription">ProductDescription</label>
                                    <textarea class="form-control" id="ProductDescription" name="ProductDescription"
                                        value="{{ old('ProductDescription') }}"></textarea> <!-- Fixed this line -->
                                    @error('ProductDescription')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="TaxId">TaxId</label>
                                    <input type="text" class="form-control" id="TaxId" name="TaxId"
                                        value="{{ old('TaxId') }}" required>
                                    @error('TaxId')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="MeasurementId">Measurement</label>
                                    <select class="form-control" id="MeasurementId" name="MeasurementId" required>

                                        <option value="kilogram"
                                            {{ old('MeasurementId') == 'kilogram' ? 'selected' : '' }}>Kilogram</option>
                                        <option value="gram" {{ old('MeasurementId') == 'gram' ? 'selected' : '' }}>Gram
                                        </option>
                                    </select>
                                    @error('MeasurementId')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col">
                                    <label for="Measurement">Measurement</label>
                                    <input type="text" class="form-control" id="Measurement" name="Measurement"
                                        value="{{ old('Measurement') }}">
                                    @error('Measurement')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                        </div>

                        <div class="form-group">
                            <label for="ProductLogo">ProductLogo</label>
                            <input type="file" class="form-control-file" id="ProductLogo" name="ProductLogo"
                                onchange="previewImage()">
                        </div>
                        <div id="imagePreview" style="margin-top: 20px;"></div>

                        <div class="text-center">
                            <button type="submit" class="btn btn-success">Save</button>
                            <a href="{{ route('product.index') }}" class="btn btn-primary">Back</a>
                            <button type="reset" class="btn btn-warning">Clear</button>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<style>
.fa-times-circle {
    color: red;
    font-size: 21px;
    position: absolute;
    top: -10px;
}
</style>

<script>
function previewImage() {
    var preview = document.getElementById('imagePreview');
    var file = document.getElementById('ProductLogo').files[0];
    var reader = new FileReader();

    reader.onloadend = function() {
        var img = document.createElement('img');
        img.src = reader.result;
        img.style.maxWidth = '150px'; // Adjust the max width as needed

        var removeBtn = document.createElement('span');
        removeBtn.innerHTML = '<i class="fas fa-times-circle"></i>';
        removeBtn.onclick = function() {
            preview.innerHTML = ''; // Remove the image
            document.getElementById('ProductLogo').value = ''; // Clear the file input
        };

        var container = document.createElement('div');
        container.style.position = 'relative';
        container.style.display = 'inline-block';

        container.appendChild(img);
        container.appendChild(removeBtn);
        preview.innerHTML = '';
        preview.appendChild(container);
    }

    if (file) {
        reader.readAsDataURL(file);
    } else {
        preview.innerHTML = 'No image selected';
    }
}
</script>

@endsection