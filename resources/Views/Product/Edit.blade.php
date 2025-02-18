@extends('adminLTE.AdminLTE_Layout')
@section('Title')
Edit Product
@endsection

@section('maincontent')
<div class="container-fluid">
    <div class="row justify-content-start">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Customer</div>
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
                    <form method="POST" action="{{ route('product.update', $product->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT') <!-- Add this line to specify that we are updating -->

                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="ProductName">Product Name</label>
                                    <input type="text" class="form-control" id="ProductName" name="ProductName" value="{{ old('ProductName', $product->ProductName) }}" required>
                                    @error('ProductName')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="ProductPrice">Product Price</label>
                                    <input type="number" class="form-control" id="ProductPrice" name="ProductPrice" value="{{ old('ProductPrice', $product->ProductPrice) }}">
                                    @error('ProductPrice')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="ProductType">Product Type</label>
                                    <input type="text" class="form-control" id="ProductType" name="ProductType" value="{{ old('ProductType', $product->ProductType) }}" required>
                                    @error('ProductType')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="ProductDescription">Product Description</label>
                                    <textarea class="form-control" id="ProductDescription" name="ProductDescription">{{ old('ProductDescription', $product->ProductDescription) }}</textarea>
                                    @error('ProductDescription')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="TaxId">Tax ID</label>
                                    <input type="text" class="form-control" id="TaxId" name="TaxId" value="{{ old('TaxId', $product->TaxId) }}" required>
                                    @error('TaxId')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="MeasurementId">Measurement</label>
                                    <select class="form-control" id="MeasurementId" name="MeasurementId" required>
                                        <option value="kilogram" {{ old('MeasurementId', $product->MeasurementId) == 'kilogram' ? 'selected' : '' }}>Kilogram</option>
                                        <option value="gram" {{ old('MeasurementId', $product->MeasurementId) == 'gram' ? 'selected' : '' }}>Gram</option>
                                    </select>
                                    @error('MeasurementId')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="Measurement">Measurement</label>
                                    <input type="text" class="form-control" id="Measurement" name="Measurement" value="{{ old('Measurement', $product->Measurement) }}">
                                    @error('Measurement')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                       
                        <div class="form-group">
                            <label for="Image">Image</label>
                            <input type="file" class="form-control-file" id="Image" name="ProductLogo" onchange="previewImage()">
                        </div>

                        <div id="imagePreview" style="margin-top: 5px;">
                            @if($product->ProductLogo)
                            <img src="{{ asset('ProductLogos/'.$product->ProductLogo) }}" style="max-width:150px;">

                            <span id="DeleteImageButton" onclick="toggleImageRemoval()" style=" top: 0;  cursor: pointer;">
                                <i class="fas fa-times-circle"></i>
                            </span>

                            <input type="hidden" name="DeleteImage" id="DeleteImageInput" value="0">
                            @endif
                        </div>
                        <style>
                            #imagePreview {
                                position: relative;
                            }

                            #DeleteImageButton {
                                font-size: 21px;
                                position: absolute;

                                top: -10px;
                            }
                        </style>

                        <div class="text-center">
                            <button type="submit" class="btn btn-success">Update</button>
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
        var file = document.getElementById('Image').files[0];
        var reader = new FileReader();

        reader.onloadend = function() {
            var img = document.createElement('img');
            img.src = reader.result;
            img.style.maxWidth = '150px'; // Adjust the max width as needed

            var removeBtn = document.createElement('span');
            removeBtn.innerHTML = '<i class="fas fa-times-circle"></i>';
            removeBtn.onclick = function() {
                preview.innerHTML = ''; // Remove the image
                document.getElementById('Image').value = ''; // Clear the file input
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

    function toggleImageRemoval() {
        var deleteInput = document.getElementById('DeleteImageInput');
        var deleteButton = document.getElementById('DeleteImageButton');
        var imagePreview = document.getElementById('imagePreview');

        if (deleteInput.value == 0) {
            deleteInput.value = 1;
            deleteButton.innerHTML = '<i class="fas fa-image"></i> Keep Image';
            deleteButton.classList.remove('btn-danger');
            deleteButton.classList.add('btn-success');
            imagePreview.style.display = 'none'; // Hide the image container
        } else {
            deleteInput.value = 0;
            deleteButton.innerHTML = '<i class="fas fa-trash-alt"></i> Remove Image';
            deleteButton.classList.remove('btn-success');
            deleteButton.classList.add('btn-danger');
            imagePreview.style.display = 'block'; // Show the image container
        }
    }
</script>

@endsection