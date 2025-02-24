@extends('adminLTE.adminLTE_layout')
@section('Tittle')
Create Customer
@endsection
<!--Main Content-->
@section('maincontent')
<div class="container-fluid">
    <div class="row justify-content-start">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header bg-default text-black">Add Customer</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('customer.store') }}" enctype="multipart/form-data"
                        id="employeeForm">
                        @csrf
                        <div class="form-group">
                            <label for="Name">Name</label>
                            <input type="text" class="form-control @error('Name') is-invalid @enderror" id="Name"
                                name="Name" value="{{ old('Name') }}" placeholder="Enter Name"
                                autocomplete="new-password" required>
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
                                    <input type="text" class="form-control @error('Email') is-invalid @enderror"
                                        id="Email" name="Email" value="{{ old('Email') }}" placeholder="Enter Email"
                                        autocomplete="new-password" required>
                                    <span class="invalid-feedback" role="alert">
                                        @error('Email')
                                        <strong>{{ $message }}</strong>
                                        @enderror
                                    </span>
                                </div>
                                <div class="col">
                                    <label for="Phonenumber">Phonenumber</label>
                                    <input type="text" class="form-control @error('Phonenumber') is-invalid @enderror"
                                        id="Phonenumber" name="Phonenumber" value="{{ old('Phonenumber') }}"
                                        pattern="[0-9]*" placeholder="Enter Phone Number" required>
                                    <small class="form-text text-muted">Please Enter Phone Number !</small>
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
                                    <input type="text" class="form-control" id="DoorNo" name="DoorNo"
                                        value="{{ old('DoorNo') }}" placeholder="Enter Door No" required>
                                </div>
                                <div class="col">
                                    <label for="Street">Street</label>
                                    <input type="text" class="form-control" id="Street" name="Street"
                                        value="{{ old('Street') }}" placeholder="Enter Street" required>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row">
                                <div class="col">
                                    <label for="City">City</label>
                                    <input type="text" class="form-control" id="City" name="City"
                                        value="{{ old('City') }}" placeholder="Enter City" required>
                                </div>
                                <div class="col">
                                    <label for="Pincode">Pincode</label>
                                    <input type="number" class="form-control" id="Pincode" name="Pincode"
                                        value="{{ old('Pincode') }}" placeholder="Enter Pincode" pattern="[0-9]*"
                                        required>
                                    <small class="form-text text-muted">Please Enter Pincode !</small>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="Image">Image</label>
                            <input type="file" class="form-control-file" id="Image" name="Image"
                                onchange="previewImage()" placeholder="Choose Image">
                        </div>
                        <div id="imagePreview" style="margin-top: 5px;"></div>
                        <div class="text-center">
                            <button type="submit" class="btn btn-success">Save</button>
                            <a href="{{ route('customer.index') }}" class="btn btn-primary">Back</a>
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
        img.style.maxWidth = '150px';

        var removeBtn = document.createElement('span');
        removeBtn.innerHTML = '<i class="fas fa-times-circle"></i>';
        removeBtn.onclick = function() {
            preview.innerHTML = '';
            document.getElementById('Image').value = '';
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