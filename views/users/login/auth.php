<div class="container">
    <div class="row">
        <div class="col-md-6 mx-auto my-5">
            <h4 class="mb-5 text-center">صفحه ورود به پنل</h4>
            <form action="/login" method="post">
                <?php
                if(isset($errors)){
                    foreach ($errors as $error){
                        echo "<p class='alert alert-danger'>$error</p>";
                    }
                }
                ?>
                <label for="email" class="form-label">ایمیل</label>
                <div class="mb-3">
                    <input type="email" class="form-control text-start" id="email" name="email" value="<?= $_POST['email'] ?? '' ?>">
                </div>
                <label for="password" class="form-label">رمز عبور</label>
                <div class="mb-3">
                    <input type="password" class="form-control" id="password" name="password" value="<?= $_POST['password'] ?? '' ?>">
                </div>
                <button type="submit" name="submit" class="btn btn-success px-4">ورود</button>
                <br><br>
                <a href="/register">ثبت نام نکرده اید؟ اینجا کلیک کنید</a>
            </form>
        </div>
    </div>
</div>