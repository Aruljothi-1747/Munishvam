@extends('adminLTE.adminLTE_layout')
@section('Title')
Edit Product
@endsection

@section('maincontent')
<div class="container-fluid">
    <div class="row justify-content-start">
        <div class="col-md-12">
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
                    <form method="POST" action="{{ route('product.update', $product->id) }}"
                        enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <!-- Add this line to specify that we are updating -->

                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="ProductName">Product Name</label>
                                    <input type="text" class="form-control" id="ProductName" name="ProductName"
                                        value="{{ old('ProductName', $product->ProductName) }}" required>
                                    @error('ProductName')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="ProductPrice">Product Price</label>
                                    <input type="number" class="form-control" id="ProductPrice" name="ProductPrice"
                                        value="{{ old('ProductPrice', $product->ProductPrice) }}">
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
                                    <input type="text" class="form-control" id="ProductType" name="ProductType"
                                        value="{{ old('ProductType', $product->ProductType) }}" required>
                                    @error('ProductType')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="ProductDescription">Product Description</label>
                                    <textarea class="form-control" id="ProductDescription"
                                        name="ProductDescription">{{ old('ProductDescription', $product->ProductDescription) }}</textarea>
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
                                    <input type="text" class="form-control" id="TaxId" name="TaxId"
                                        value="{{ old('TaxId', $product->TaxId) }}" required>
                                    @error('TaxId')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="MeasurementId">Measurement</label>
                                    <select class="form-control" id="MeasurementId" name="MeasurementId" required>
                                        <option value="kilogram"
                                            {{ old('MeasurementId', $product->MeasurementId) == 'kilogram' ? 'selected' : '' }}>
                                            Kilogram</option>
                                        <option value="gram"
                                            {{ old('MeasurementId', $product->MeasurementId) == 'gram' ? 'selected' : '' }}>
                                            Gram</option>
                                    </select>
                                    @error('MeasurementId')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for="Measurement">Measurement</label>
                                    <input type="text" class="form-control" id="Measurement" name="Measurement"
                                        value="{{ old('Measurement', $product->Measurement) }}">
                                    @error('Measurement')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>


                        <div class="form-group">
                            <label for="ProductLogo">Product Logos</label>
                            <div class="row">
                                @foreach (['ProductLogo', 'ProductLogo2', 'ProductLogo3', 'ProductLogo4',
                                'ProductLogo5'] as $index => $field)
                                <div class="col">
                                    <div class="mb-2 position-relative">
                                        <img id="selectedImage{{ $index + 1 }}"
                                            src="{{ $product->{$field} ? asset('ProductLogos/' . $product->{$field}) : asset('img/placeholder.jpg') }}"
                                            alt="Product Logo"
                                            style="width: 120px; border: 1px solid #ccc; border-radius: 5px;">

                                        <button type="button" class="btn btn-danger btn-sm delete-image-btn"
                                            data-index="{{ $index + 1 }}" style="position: absolute;">&times;</button>
                                    </div>
                                    <div class="mt-2">
                                        <label class="btn btn-primary btn-sm" for="customFile{{ $index + 1 }}">Choose
                                            File</label>
                                        <input type="file" name="{{ $field }}" id="customFile{{ $index + 1 }}"
                                            class="form-control d-none"
                                            onchange="displaySelectedImage(event, 'selectedImage{{ $index + 1 }}')">
                                        <input type="hidden" name="DeleteImage_{{ $field }}"
                                            id="DeleteImageInput{{ $index + 1 }}" value="0">
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                        <script>
                        function displaySelectedImage(event, elementId) {
                            const selectedImage = document.getElementById(elementId);
                            const fileInput = event.target;

                            if (fileInput.files && fileInput.files[0]) {
                                const reader = new FileReader();
                                reader.onload = function(e) {
                                    selectedImage.src = e.target.result;
                                    selectedImage.style.display = 'block';
                                };
                                reader.readAsDataURL(fileInput.files[0]);
                            }
                        }

                        document.querySelectorAll('.delete-image-btn').forEach(button => {
                            button.addEventListener('click', function() {
                                const index = this.dataset.index;
                                const imageElement = document.getElementById('selectedImage' + index);
                                const deleteInput = document.getElementById('DeleteImageInput' + index);

                                deleteInput.value = deleteInput.value === "0" ? "1" : "0";
                                imageElement.src = deleteInput.value === "1" ? '/img/placeholder.jpg' :
                                    imageElement.getAttribute('data-original');
                                imageElement.style.display = 'block';
                            });
                        });
                        </script>


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

@endsection