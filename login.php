<style>
    .form-container {
        width: min(75ch, 100% - 4rem);
        margin-inline: auto;
    }

    .form-body .basta img {
        width: 50px;
    }

    .error_alert {
        background: red;
        padding: .6em;
        font-weight: bold;
        color: white;
        border-radius: .2em;
    }
</style>

<div class="form-container flex flex-col gap-4 w-1/2">
    <div class="form-header">
        <p id="login" class="ui button primary">Login</p>
        <p id="signup" class="ui button">Signup</p>
    </div>



    <form method="post" class="form-body">
        <div class="ui form md:shadow py-9 md:p-9 rounded basta">
            <div class="header flex flex-col justify-center items-center">
                <img src="https://www.transparentpng.com/thumb/diamond/O3UOts-diamond-best-png.png" alt="">
                <h2 class="ui header">Welcome Back</h2>
                <label>Glad to see you again</label>
            </div>
            <div class="form-inputs flex gap-4 mt-8">
                <div class="inputs-1 w-full">
                    <div class="field">
                        <label>Email</label>
                        <input type="email" name="email" placeholder="Enter your email" required>
                    </div>
                    <div class="field">
                        <label>Password</label>
                        <input type="password" name="password" placeholder="Enter your password" required>
                    </div>
                </div>
            </div>
            <div class="buttons mt-4 flex flex-col md:flex-row gap-4 items-center">
                <p class="w-full flex gap-2 my-4 md:my-0">Don't have an account yet? <a href="signup"><b>Sign Up</b></a></p>
                <button type="submit" class="ui primary button w-full login">Login</button>
            </div>
        </div>
    </form>
</div>

<script>
    $(document).ready(function() {
        // Handle click events for login and signup buttons
        $('#login').click(function() {
            window.location.href = "login"; // Corrected to handle login click
        });
        $('#signup').click(function() {
            window.location.href = "signup"; // Adjusted to handle signup click
        });

        $('.form-body').submit(function(e) {
            $('.login').css('opacity', '0.5');
            e.preventDefault(); // Prevent default form submission
            $.ajax({
                type: 'POST',
                url: 'admin/ajax.php?action=login',
                data: $(this).serialize(), // Serialize form data
                success: function(response) {
                    if (response == 1) {
                        $('.error_alert').remove();
                        window.location.href = "admin/dashboard"; // Redirect to dashboard on successful login
                    } else if (response == 2) {
                        $('.login').css('opacity', '1');
                        $('.error_alert').remove();
                        var errorDiv = document.createElement('div');
                        errorDiv.innerHTML = '<p class="error_alert">Wrong password</p>';
                        document.querySelector('.inputs-1').appendChild(errorDiv);

                    } else if (response == 3) {
                        $('.login').css('opacity', '1');
                        $('.error_alert').remove();
                        var errorDiv = document.createElement('div');
                        errorDiv.innerHTML = '<p class="error_alert">User does not exist</p>';
                        document.querySelector('.inputs-1').appendChild(errorDiv);
                    } else {
                        alert('Unknown error occurred'); // Handle other errors if needed
                    }
                },
                error: function(xhr, status, error) {
                    console.error(xhr.responseText); // Log any errors to console
                    alert('Error occurred, please try again'); // Show generic error message
                }
            });
        });


    });
</script>