<style>
    .form-container {
        width: min(75ch, 100% - 4rem);
        margin-inline: auto;
    }

    .form-body .basta img {
        width: 50px;
    }
</style>

<div class="form-container flex flex-col gap-4 w-1/2">
    <div class="form-header">
        <p id="login" class="ui button primary">Login</p>
        <p id="signup" class="ui button">signup</p>
    </div>
    <script>
        $(document).ready(function() {
            $('#login').click(function() {
                window.location.href = "login";
            });
            $('#signup').click(function() {
                window.location.href = "signup";
            });
            $('.buttons p').click(function() {
                window.location.href = "login";
            });
        });
    </script>
    <form method="post" class="form-body">
        <div class="ui form md:shadow py-9 md:p-9 rounded basta">
            <img src="https://www.transparentpng.com/thumb/diamond/O3UOts-diamond-best-png.png" alt="">
            <h2 class="ui header">Sign up</h2>
            <label>Enter your details below...</label>
            <div class="form-inputs flex flex-col md:flex-row gap-4 mt-8">
                <div class="inputs-1 w-full">
                    <div class="field">
                        <label>Full Name</label>
                        <input type="text" name="fullname" id="fullname" placeholder="Enter your full name">
                        <div id="fullnameError" class="error-message"></div>
                    </div>
                    <div class="field">
                        <label>Email</label>
                        <input type="email" name="email" id="email" placeholder="Enter your email">
                        <div id="emailError" class="error-message"></div>
                    </div>
                    <div class="field">
                        <label>Date of Birth</label>
                        <input type="date" name="dob" id="dob" placeholder="Select your date of birth">
                        <div id="dobError" class="error-message"></div>
                    </div>
                    <div class="field">
                        <label>Phone Number</label>
                        <input type="tel" name="phone" id="phone" placeholder="Enter your phone number">
                        <div id="phoneError" class="error-message"></div>
                    </div>
                </div>
                <div class="inputs-2 w-full">
                    <div class="field">
                        <label>Nationality</label>
                        <input type="text" name="nationality" id="nationality" placeholder="Enter your nationality">
                        <div id="nationalityError" class="error-message"></div>
                    </div>
                    <div class="field">
                        <label>ID</label>
                        <input type="text" name="id" id="id" placeholder="Enter your ID">
                        <div id="idError" class="error-message"></div>
                    </div>
                    <div class="field">
                        <label>Password</label>
                        <input type="password" name="password" id="password" placeholder="Enter your password">
                        <div id="passwordError" class="error-message"></div>
                    </div>
                    <div class="field">
                        <label>Confirm Password</label>
                        <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirm your password">
                        <div id="confirmPasswordError" class="error-message"></div>
                    </div>
                </div>
            </div>

            <div class="buttons my-4 flex gap-4">
                <p class="ui button w-full">Cancel</p>
                <button class="ui primary button w-full">Confirm</button>
            </div>
            <footer class="text-center">
                <p>Already have an account? <a href="login" onclick="validateForm()"><b>Login</b></a></p>
            </footer>
        </div>

    </form>
</div>








<script>
    $(document).ready(function() {
        $('.form-body').submit(function(e) {
            e.preventDefault(); // Prevent default form submission

            // Clear previous error messages
            $('.error-message').text('');

            // Validate form fields
            var isValid = true;

            $('.form-body input').each(function() {
                if ($(this).val() === '') {
                    var fieldName = $(this).attr('name');
                    var errorMessage = fieldName.charAt(0).toUpperCase() + fieldName.slice(1) + ' is required';
                    $(this).next('.error-message').text(errorMessage);
                    $(this).next('.error-message').css({
                        color: 'white',
                        background: 'red',
                        paddingLeft: '.6em'

                    });

                    isValid = false;
                } else if ($('#password').val() !== $('#confirm_password').val()) {
                    var errorMessage = 'Passwords do not match';
                    $('#confirm_password').next('.error-message').text(errorMessage);
                    $('#confirm_password').next('.error-message').css({
                        color: 'white',
                        background: 'red',
                        paddingLeft: '.6em'
                    });
                    isValid = false;
                }


            });

            if (isValid) {
                $.ajax({
                    type: 'POST',
                    url: 'admin/ajax.php?action=signup',
                    data: $(this).serialize(),
                    success: function(response) {
                        if (response == '1') {
                            window.location.href = "login";
                        } else if (response == '5') {
                            var errorMessage = 'Email already exists';
                            $('#email').next('.error-message').text(errorMessage);
                            $('#email').next('.error-message').css({
                                color: 'white',
                                background: 'red',
                                paddingLeft: '.6em'
                            });
                        }
                    }
                });
            } else {

            }
        });
    });
</script>