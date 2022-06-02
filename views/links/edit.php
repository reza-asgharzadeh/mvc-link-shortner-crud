<div class="container">
    <div class="d-flex justify-content-between mt-3">
        <div><h4 class="mb-5 text-center text-muted">ویرایش لینک</h4></div>
        <div>ایمیل شما: <?php echo $_SESSION['email']?></div>
        <form action="/logout" method="post">
            <button class="btn btn-sm btn-danger">خروج</button>
        </form>
    </div>
    <div class="row">
        <div class="col-md-6">
            <form action="/links/update" method="post">
                <input type="hidden" name="link_id" value="<?= $link['id'] ?>">
                <div class="mb-4">
                    <label for="original_link" class="form-label text-secondary">ویرایش لینک اصلی به صورت دستی</label>
                    <input type="text" class="form-control" id="original_link" dir="ltr" name="original_link" value="<?= $link['original_link'] ?>" placeholder="ویرایش لینک اصلی" required>
                </div>
                <div class="mb-4">
                    <label for="short_link" class="form-label text-secondary">ویرایش لینک کوتاه به صورت اتوماتیک</label>
                    <input type="text" class="form-control" id="short_link" dir="ltr" name="short_link" value="<?= $link['short_link'] ?>" disabled>
                </div>
                <button type="submit" name="submit" class="btn btn-primary">ویرایش لینک</button>
                <a class="btn btn-danger" href="/links">انصراف</a>
            </form>
        </div>
    </div>
</div>