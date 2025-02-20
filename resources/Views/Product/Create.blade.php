@extends('adminLTE.AdminLTE_Layout')
@section('Tittle')
Create Product
@endsection

<!--Main Content-->
@section('maincontent')
<div class="container-fluid">
    <div class="row justify-content-start">
        <div class="col-md-12">
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
                            <label for="ProductLogo">Product Logos</label>
                            <div class="row">
                                <!-- First Image Preview -->
                                <div class="col">
                                    <div class="mb-2 form-group-row">
                                        <img id="selectedImage1" src="img/placeholder.jpg" alt="example placeholder"
                                            style="width: 120px; border: 1px solid #ccc; border-radius: 5px;" />
                                        <button type="button" class="btn btn-danger btn-sm"
                                            style="position: absolute; top: -5px; right: 100px; border-radius: 50%;"
                                            onclick="removeImage('selectedImage1', 'customFile1')">
                                            &times;
                                        </button>
                                    </div>
                                    <div class="mt-2">
                                        <label class="btn btn-primary btn-sm" for="customFile1">Choose File</label>
                                        <input type="file" class="form-control d-none" id="customFile1"
                                            name="ProductLogo"
                                            onchange="displaySelectedImage(event, 'selectedImage1')" />

                                    </div>
                                </div>

                                <!-- Second Image Preview -->
                                <div class="col">
                                    <div class="mb-2 form-group-row">
                                        <img id="selectedImage2" src="img/placeholder.jpg" alt="example placeholder"
                                            style="width: 120px; border: 1px solid #ccc; border-radius: 5px;" />
                                        <button type="button" class="btn btn-danger btn-sm"
                                            style="position: absolute; top: -5px; right: 100px; border-radius: 50%;"
                                            onclick="removeImage('selectedImage2', 'customFile2')">
                                            &times;
                                        </button>
                                    </div>
                                    <div class="mt-2">
                                        <label class="btn btn-primary btn-sm" for="customFile2">Choose File</label>
                                        <input type="file" class="form-control d-none" id="customFile2"
                                            name="ProductLogo2"
                                            onchange="displaySelectedImage(event, 'selectedImage2')" />
                                    </div>

                                </div>

                                <!-- Third Image Preview -->
                                <div class="col">
                                    <div class="mb-2 form-group-row">
                                        <img id="selectedImage3" src="img/placeholder.jpg" alt="example placeholder"
                                            style="width: 120px; border: 1px solid #ccc; border-radius: 5px;" />
                                        <button type="button" class="btn btn-danger btn-sm"
                                            style="position: absolute; top: -5px; right: 100px; border-radius: 50%;"
                                            onclick="removeImage('selectedImage3', 'customFile3')">
                                            &times;
                                        </button>
                                    </div>
                                    <div class="mt-2">
                                        <label class="btn btn-primary btn-sm" for="customFile3">Choose File</label>
                                        <input type="file" class="form-control d-none" id="customFile3"
                                            name="ProductLogo3"
                                            onchange="displaySelectedImage(event, 'selectedImage3')" />
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="mb-2 form-group-row">
                                        <img id="selectedImage4" src="img/placeholder.jpg" alt="example placeholder"
                                            style="width: 120px; border: 1px solid #ccc; border-radius: 5px;" />
                                        <button type="button" class="btn btn-danger btn-sm"
                                            style="position: absolute; top: -5px; right: 100px; border-radius: 50%;"
                                            onclick="removeImage('selectedImage4', 'customFile4')">
                                            &times;
                                        </button>
                                    </div>
                                    <div class="mt-2">
                                        <label class="btn btn-primary btn-sm" for="customFile4">Choose File</label>
                                        <input type="file" class="form-control d-none" id="customFile4"
                                            name="ProductLogo4"
                                            onchange="displaySelectedImage(event, 'selectedImage4')" />
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="mb-2 form-group-row">
                                        <img id="selectedImage5" src="img/placeholder.jpg" alt="example placeholder"
                                            style="width: 120px; border: 1px solid #ccc; border-radius: 5px;" />
                                        <button type="button" class="btn btn-danger btn-sm"
                                            style="position: absolute; top: -5px; right: 100px; border-radius: 50%;"
                                            onclick="removeImage('selectedImage5', 'customFile5')">
                                            &times;
                                        </button>
                                    </div>
                                    <div class="mt-2">
                                        <label class="btn btn-primary btn-sm" for="customFile5">Choose File</label>
                                        <input type="file" class="form-control d-none" id="customFile5"
                                            name="ProductLogo5"
                                            onchange="displaySelectedImage(event, 'selectedImage5')" />
                                    </div>
                                </div>

                                <!-- Additional images can be added similarly -->
                            </div>
                        </div>




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
function displaySelectedImage(event, elementId) {
    const selectedImage = document.getElementById(elementId);
    const fileInput = event.target;

    if (fileInput.files && fileInput.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            selectedImage.src = e.target.result;
        };

        reader.readAsDataURL(fileInput.files[0]);
    }
}

function removeImage(imageId, inputId) {
    const imageElement = document.getElementById(imageId);
    const inputElement = document.getElementById(inputId);

    // Reset the image to the placeholder
    imageElement.src = "img/placeholder.jpg";

    // Clear the file input
    inputElement.value = "";
}
</script>

@endsection