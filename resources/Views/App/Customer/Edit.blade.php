@extends('App.Layout')
@section('Title')
Edit Customer
@endsection
@section('maincontent')
<div class="container-fluid">
    <div class="row justify-content-start">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Customer</div>
                <div class="card-body">
                   
                    <form method="POST" action="{{ route('customer.update', $customer->id) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-group">
                            <label for="Name">Name</label>
                            <input type="text" class="form-control @error('Name') is-invalid @enderror" id="Name" name="Name" value="{{ $customer->Name }}" required>
                            <span class="invalid-feedback" role="alert">
                                @error('Name')
                                    <strong>{{ $message }}</strong>
                                @enderror
                            </span>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="Email">Email</label>
                                    <input type="text" class="form-control @error('Email') is-invalid @enderror" id="Email" name="Email" value="{{ $customer->Email }}">
                                    <span class="invalid-feedback" role="alert">
                                        @error('Email')
                                            <strong>{{ $message }}</strong>
                                        @enderror
                                    </span>
                                </div>
                                <div class="col">
                                    <label for="Phonenumber">Phone Number</label>
                                    <input type="number" class="form-control @error('Phonenumber') is-invalid @enderror" id="Phonenumber" name="Phonenumber" value="{{ $customer->Phonenumber }}" required>
                                    <span class="invalid-feedback" role="alert">
                                        @error('Phonenumber')
                                            <strong>{{ $message }}</strong>
                                        @enderror
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="DoorNo">Door No</label>
                                    <input type="text" class="form-control" id="DoorNo" name="DoorNo" value="{{ $addressParts[0] ?? '' }}" placeholder="Door No" required>
                                </div>
                                <div class="col">
                                    <label for="Street">Street</label>
                                    <input type="text" class="form-control" id="Street" name="Street" value="{{ $addressParts[1] ?? '' }}" placeholder="Street" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="City">City</label>
                                    <input type="text" class="form-control" id="City" name="City" value="{{ $addressParts[2] ?? '' }}" placeholder="City" required>
                                    <span class="invalid-feedback" role="alert">
                                        @error('City')
                                            <strong>{{ $message }}</strong>
                                        @enderror
                                    </span>
                                </div>
                                <div class="col">
                                    <label for="Pincode">Pincode</label>
                                    <input type="number" class="form-control" id="Pincode" name="Pincode" value="{{ $customer->Pincode }}" required>
                                    <span class="invalid-feedback" role="alert">
                                        @error('Pincode')
                                            <strong>{{ $message }}</strong>
                                        @enderror
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Image">Image</label>
                            <input type="file" class="form-control-file" id="Image" name="Image" onchange="previewImage()">
                        </div>
                        <div id="imagePreview" style="margin-top: 5px;">
                            @if($customer->Image)
                            <img src="{{ asset('images/'.$customer->Image) }}" style="max-width: 150px;">
                            <span id="DeleteImageButton" onclick="toggleImageRemoval()" style=" top: 0;  cursor: pointer;">
                                <i class="fas fa-times-circle"></i>
                            </span>
                            <input type="hidden" name="DeleteImage" id="DeleteImageInput" value="0">
                            @endif
                        </div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success">Update</button>
                            <a href="{{ route('customer.index') }}" class="btn btn-primary">Back</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
