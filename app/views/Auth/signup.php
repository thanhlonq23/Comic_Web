<style>
    .error {
        color: red;
        font-size: 14px;
        margin-top: 5px;
        display: block;
    }
</style>

<section class="vh-200" style="background-color: #eee;">
    <div class="container h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-lg-12 col-xl-11">
                <div class="card text-black" style="border-radius: 25px;">
                    <div class="card-body p-md-5">
                        <div class="row justify-content-center">
                            <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Đăng kí tài khoản</p>

                            <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">
                                <a href="<?php echo BASE_URL ?>">
                                    <img src="./public/Logo/f4.jpg" class="img-fluid">
                                </a>
                            </div>

                            <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                                <form class="mx-1 mx-md-4" action="<?php echo BASE_URL ?>/?url=signup/signup" onsubmit="return validateForm()" method="post">
                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <label class="form-label" for="name">Tên người dùng</label>
                                            <input type="text" name="name" id="name" class="form-control" />
                                            <span id="fullnameError" class="error"></span><br>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <label class="form-label" for="username">Tên đăng nhập</label>
                                            <input type="text" name="username" id="username" class="form-control" />
                                            <span id="usernameError" class="error"></span><br>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <label class="form-label" for="password">Mật khẩu</label>
                                            <input type="password" name="password" id="password" class="form-control" oninput="validatePassword()" />
                                            <span id="passwordError" class="error"></span>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <label class="form-label" for="rePassword">Nhập lại mật khẩu</label>
                                            <input type="password" name="rePassword" id="rePassword" class="form-control" oninput="validateConfirmPassword()" />
                                            <span id="confirmPasswordError" class="error"></span>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <label class="form-label" for="email">Email</label>
                                            <input type="email" name="email" id="email" class="form-control" />
                                            <span id="emailError" class="error"></span><br>
                                        </div>
                                    </div>

                                    <div class="d-flex flex-row align-items-center mb-4">
                                        <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                                        <div class="form-outline flex-fill mb-0">
                                            <label class="form-label" for="phoneNumber">Số điện thoại</label>
                                            <input type="text" name="phoneNumber" id="phoneNumber" class="form-control" />
                                            <span id="phoneError" class="error"></span><br>
                                        </div>
                                    </div>

                                    <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                                        <button type="submit" class="btn btn-primary btn-lg">Đăng kí</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    function validateForm() {
        // Lấy giá trị từ các ô nhập
        var fullname = document.getElementById('name').value;
        var username = document.getElementById('username').value;
        var password = document.getElementById('password').value;
        var confirm_password = document.getElementById('rePassword').value;
        var email = document.getElementById('email').value;
        var phone = document.getElementById('phoneNumber').value;

        var valid = true;
        // Kiểm tra Tên người dùng có bị bỏ trống không
        if (fullname.trim() === "") {
            document.getElementById('fullnameError').innerHTML = "Tên người dùng không được bỏ trống.";
            valid = false;
        } else {
            document.getElementById('fullnameError').innerHTML = "";
        }

        // Kiểm tra tên đăng nhập có ít nhất 6 kí tự
        if (username.length < 6) {
            document.getElementById('usernameError').innerHTML = "Tên đăng nhập phải có ít nhất 6 kí tự.";
            valid = false;
        } else {
            document.getElementById('usernameError').innerHTML = "";
        }

        validatePassword();
        validateConfirmPassword();

        // Kiểm tra Email có bị bỏ trống và đúng định dạng không
        if (email.trim() === "" || !validateEmail(email)) {
            document.getElementById('emailError').innerHTML = "Email không được bỏ trống và phải đúng định dạng.";
            valid = false;
        } else {
            document.getElementById('emailError').innerHTML = "";
        }

        // Kiểm tra số điện thoại chỉ chứa số và có đúng 10 kí tự
        if (!/^\d{10}$/.test(phone)) {
            document.getElementById('phoneError').innerHTML = "Số điện thoại không hợp lệ.";
            valid = false;
        } else {
            document.getElementById('phoneError').innerHTML = "";
        }

        return valid;
    }


    function validatePassword() {
        var password = document.getElementById('password').value;
        var passwordError = document.getElementById('passwordError');
        if (password.trim() === "") {
            passwordError.innerHTML = "Mật khẩu không được bỏ trống.";
            valid = false;
        } else {
            passwordError.innerHTML = "";
        }
    }

// Function để kiểm tra Nhập lại mật khẩu
function validateConfirmPassword() {
    var password = document.getElementById('password').value;
    var confirm_password = document.getElementById('rePassword').value;
    var confirmPasswordError = document.getElementById('confirmPasswordError');

    if (confirm_password.trim() === "") {
        confirmPasswordError.innerHTML = "Vui lòng nhập lại mật khẩu.";
        valid = false;
    } else if (password !== confirm_password) {
        confirmPasswordError.innerHTML = "Mật khẩu không khớp.";
    } else {
        confirmPasswordError.innerHTML = "";
    }
}

    function validateEmail(email) {
        //Check định dạng emil
        var re = /\S+@\S+\.\S+/;
        return re.test(email);
    }
</script>