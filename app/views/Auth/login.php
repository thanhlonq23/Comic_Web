<style>
    .error {
        color: red;
        font-size: 14px;
        margin-top: 5px;
    }

    /* Card và nội dung */
    .card {
        border-radius: 1rem;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    /* Form */
    form {
        padding: 30px;
    }

    /* Tiêu đề */
    .card-body h1 {
        font-size: 24px;
        font-weight: bold;
        margin-bottom: 20px;
    }

    /* Các input và label */
    .form-outline {
        margin-bottom: 20px;
    }

    .form-label {
        font-size: 14px;
        font-weight: bold;
        color: #333;
    }

    /* Nút Login */
    .btn-login {
        padding: 12px 20px;
        font-size: 16px;
        font-weight: bold;
        background-color: #333;
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
    }

    /* Liên kết đăng ký */
    .register-link {
        text-align: center;
        font-size: 14px;
        color: #333;
    }

    .register-link a {
        color: #007bff;
        text-decoration: none;
    }
</style>

<br><br>
<section class="vh-100">
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col col-xl-10">
                <div class="card" style="border-radius: 1rem;">
                    <div class="row g-0">
                        <div class="col-md-6 col-lg-5 d-none d-md-flex d-flex align-items-center justify-content-center">
                            <a href="<?php echo BASE_URL ?>">
                                <img src="./public/Logo/f4.jpg" alt="login form" class="img-fluid" style="border-radius: 1rem 0 0 1rem;">
                            </a>
                        </div>

                        <div class="col-md-6 col-lg-7 d-flex align-items-center">
                            <div class="card-body p-4 p-lg-5 text-black">

                                <!-- Form đăng nhập -->
                                <form autocomplete="off" action="<?php echo BASE_URL ?>/?url=login/auth_login" method="POST">

                                    <div class="d-flex align-items-center mb-3 pb-1">
                                        <span class="h1 fw-bold mb-0">Đăng nhập</span>
                                    </div>

                                    <h5 class="fw-normal mb-3 pb-3" style="letter-spacing: 1px;">
                                        <?php
                                        if (!empty($_GET['msg'])) {
                                            $msg = unserialize(urldecode($_GET['msg']));
                                            foreach ($msg as $key => $value) {
                                                echo "<p style='color: red'><br> $value </p>";
                                            }
                                        }
                                        ?>
                                    </h5>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="Username">Username</label>
                                        <input type="text" name="username" id="Username" class="form-control form-control-lg" />
                                        <span id="usernameError" class="error"></span>
                                    </div>

                                    <div class="form-outline mb-4">
                                        <label class="form-label" for="Password">Password</label>
                                        <input type="password" name="password" id="Password" class="form-control form-control-lg" />
                                        <span id="passwordError" class="error"></span>
                                    </div>

                                    <div class="pt-1 mb-4">
                                        <button class="btn btn-dark btn-lg btn-block" type="submit" onclick="return validateLoginForm()">Login</button>
                                    </div>

                                    <p class="mb-5 pb-lg-2" style="color: #393f81;">
                                        <br>Bạn chưa có tài khoản?
                                        <a href="<?php echo BASE_URL ?>/?url=signup" style="text-decoration: none;"><br>Đăng kí ở đây</a>
                                    </p>
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
    function validateLoginForm() {
        var username = document.getElementById('form2Example17').value;
        var password = document.getElementById('form2Example27').value;
        var usernameError = document.getElementById('usernameError');
        var passwordError = document.getElementById('passwordError');

        if (username.trim() === '') {
            usernameError.innerHTML = 'Vui lòng nhập tên đăng nhập.';
            return false;
        } else {
            usernameError.innerHTML = '';
        }

        if (password.trim() === '') {
            passwordError.innerHTML = 'Vui lòng nhập mật khẩu.';
            return false;
        } else {
            passwordError.innerHTML = '';
        }

        return true;
    }
</script>