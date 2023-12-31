<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

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
        <?php if(session('success')): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <?php echo e(session('success')); ?>

            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        <?php endif; ?>
        <form action="<?php echo e(route('store.customer')); ?>" id="storecustomer" method="post">
            <?php echo csrf_field(); ?>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Name</label>
                <input type="text" class="form-control" placeholder="Customer name" id="name" name="name">
                <?php $__errorArgs = ['name'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="text-danger"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Email</label>
                <input type="email" value="<?php echo e(old('email', $oldValues['email'] ?? '')); ?>" class="form-control" placeholder="name@example.com" id="email" name="email">
                <span id="emailerror" class="text-danger"></span>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Phone</label>
                <input type="number" value="<?php echo e(old('phone', $oldValues['phone'] ?? '')); ?>" class="form-control" placeholder="Contact number" id="phone" name="phone">
                <span id="phoneerror" class="text-danger"></span>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" value="<?php echo e(old('address', $oldValues['address'] ?? '')); ?>" class="form-label">Address</label>
                <input type="text" class="form-control" placeholder="Address" id="address" name="address">
                <?php $__errorArgs = ['address'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="text-danger"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlInput1" class="form-label">Pincode</label>
                <input type="number" class="form-control" value="<?php echo e(old('pincode', $oldValues['pincode'] ?? '')); ?>" placeholder="Pin Code" id="pincode" name="pincode">
                <?php $__errorArgs = ['pincode'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                <span class="text-danger"><?php echo e($message); ?></span>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
                if (!email) {
                    emailError.text("Email field cannot be empty");
                    return;
                }
                if (!/^\S+@\S+\.\S+$/.test(email)) {
                    emailError.text("Invalid email format");
                } else {
                    checkEmailExists(email);
                }
            }

            function validatePhone(phone) {
                if (!email) {
                    phoneError.text("Phone field cannot be empty");
                    return;
                }
                if (!/^\d{10}$/.test(phone)) {
                    phoneError.text("Invalid phone number");
                } else {
                    checkPhoneExists(phone);
                }
            }

            function checkPhoneExists(phone) {
                $.ajax({
                    url: "<?php echo e(route('checkphone')); ?>",
                    method: 'POST',
                    data: {
                        phone: phone,
                        _token: '<?php echo e(csrf_token()); ?>'
                    },
                    success: function(data) {
                        if (data.exists) {
                            phoneError.text("Phone already exists");
                        } else {
                            phoneError.text("");
                        }
                    }
                });
            }

            function checkEmailExists(email) {
                $.ajax({
                    url: "<?php echo e(route('checkemail')); ?>",
                    method: 'POST',
                    data: {
                        email: email,
                        _token: '<?php echo e(csrf_token()); ?>'
                    },
                    success: function(data) {
                        if (data.exists) {
                            emailError.text("Email already exists");
                        } else {
                            emailError.text("");
                        }
                    }
                });
            }

        });
    </script>

</body>

</html><?php /**PATH C:\Users\AVNI\Desktop\interview-laravel-main\resources\views/welcome.blade.php ENDPATH**/ ?>