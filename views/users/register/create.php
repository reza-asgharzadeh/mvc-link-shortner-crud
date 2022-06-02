<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto my-5">
            <h4 class="mb-5 text-center">صفحه ثبت نام در پنل</h4>
            <form action="/register" method="post">
                <?php
                if(isset($errors)){
                    foreach ($errors as $error){
                        echo "<p class='alert alert-danger'>$error</p>";
                    }
                }
                ?>
                <label for="fullName" class="form-label">نام کامل</label>
                <div class="mb-3">
                    <input type="text" class="form-control" id="fullName" name="fullName" value="<?= $_POST['fullName'] ?? '' ?>">
                </div>
                <label for="email" class="form-label">آدرس ایمیل</label>
                <div class="mb-3">
                    <input type="email" class="form-control text-start" id="email" name="email" value="<?= $_POST['email'] ?? '' ?>">
                </div>
                <label for="password" class="form-label">رمز عبور</label>
                <div class="mb-3">
                    <input type="password" class="form-control" id="password" name="password" value="<?= $_POST['password'] ?? '' ?>">
                </div>
                <button type="submit" name="submit" class="btn btn-primary px-4">ثبت نام</button>
                <br><br>
                <a href="/login">صفحه ورود</a>
            </form>
        </div>
    </div>
</div>