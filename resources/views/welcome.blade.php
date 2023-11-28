<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Test Application</title>
   
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5">
        <h1>Customer Form</h1>
        @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
        <form action="{{ route('store.customer') }}" id="storecustomer" method="post">
            @csrf
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Name</label>
                <input type="text" class="form-control" value="{{ old('name') }}"  placeholder="Customer name" id="name" name="name">
                @error('name')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Email</label>
                <input type="email" value="{{ old('email') }}" class="form-control" placeholder="name@example.com" id="email" name="email">
                @error('email')
                <p class="text-danger">{{ $message }}</p>
                @enderror
                <p id="emailerror" class="text-danger"></p>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Phone</label>
                <input type="number" value="{{ old('phone') }}" class="form-control" placeholder="Contact number" id="phone" name="phone">
                @error('phone')
                <span class="text-danger">{{ $message }}</span>
                @enderror
                <span id="phoneerror" class="text-danger"></span>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1"  class="form-label">Address</label>
                <input type="text" class="form-control" value="{{ old('address') }}" placeholder="Address" id="address" name="address">
                @error('address')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Pincode</label>
                <input type="number" class="form-control" value="{{ old('pincode') }}" placeholder="Pin Code" id="pincode" name="pincode">
                @error('pincode')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <div class="">
                <button type="submit" class="btn btn-success">Submit</button>
            </div>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script>
        $(document).ready(function() {
            const emailInput = $("#email");
            const phoneInput = $("#phone");
            const emailError = $("#emailerror");
            const phoneError = $("#phoneerror");

            emailInput.keyup(function() {
                validateEmail(emailInput.val());
            });
            phoneInput.keyup(function() {
                validatePhone(phoneInput.val());
            });

            function validateEmail(email) {
                
                if (!/^\S+@\S+\.\S+$/.test(email)) {
                    emailError.text("Invalid email format.");
                } else {
                    checkEmailExists(email);
                }
            }

            function validatePhone(phone) {
                
                if (!/^\d{10}$/.test(phone)) {
                    phoneError.text("Invalid phone number.");
                } else {
                    checkPhoneExists(phone);
                }
            }

            function checkPhoneExists(phone) {
                $.ajax({
                    url: "{{route('checkphone')}}",
                    method: 'POST',
                    data: {
                        phone: phone,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        if (data.exists) {
                            phoneError.text("Phone already exists.");
                        } else {
                            phoneError.text("");
                        }
                    }
                });
            }

            function checkEmailExists(email) {
                $.ajax({
                    url: "{{route('checkemail')}}",
                    method: 'POST',
                    data: {
                        email: email,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(data) {
                        if (data.exists) {
                            emailError.text("Email already exists.");
                        } else {
                            emailError.text("");
                        }
                    }
                });
            }

        });
    </script>

</body>

</html>