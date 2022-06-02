<div class="container">
    <div class="d-flex justify-content-between mt-3">
        <div><h4 class="mb-5 text-center text-muted">پنل ایجاد و مدیریت لینک</h4></div>
        <div>ایمیل شما: <?=$_SESSION['email']?></div>
        <form action="/logout" method="post">
            <button class="btn btn-sm btn-danger">خروج</button>
        </form>
    </div>
    <div class="row">
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                    <tr>
                        <th scope="col">شناسه</th>
                        <th scope="col">لینک اصلی</th>
                        <th scope="col">لینک کوتاه</th>
                        <th scope="col">عملیات</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    if( !empty( $_REQUEST['requiredLink'] ) )
                    {
                        echo sprintf( '<p class="alert alert-danger fw-bold">%s</p>', $_REQUEST['requiredLink'] );
                    }
                    ?>
                    <?php foreach ($links as $link){?>
                        <tr>
                            <th scope="row"><?= $link['id'] ?></th>
                            <td><?= $link['original_link'] ?></td>
                            <td><a href="<?= $link['original_link'] ?>" target="_blank"><?= $link['short_link'] ?></a></td>
                            <td>
                                <div class="d-flex">
                                <form class="d-inline-block" action="/links/edit" method="post">
                                    <input type="hidden" name="link_id" value="<?= $link['id'] ?>">
                                    <button class="btn btn-sm btn-primary">ویرایش</button>
                                </form>
                                <form class="d-inline-block mx-2" action="/links/remove" method="post">
                                    <input type="hidden" name="link_id" value="<?= $link['id'] ?>">
                                    <button class="btn btn-sm btn-danger">حذف</button>
                                </form>
                                </div>
                            </td>
                        </tr>
                    <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        <div class="col-md-6">
            <form action="/links" method="post">
                <div class="mb-3">
                    <input type="text" class="form-control" dir="ltr" name="original_link" placeholder="example.com/url-short-test-aparat-active-link" value="<?= $_POST['original_link'] ?? '' ?>">
                </div>
                <button type="submit" name="submit" class="btn btn-primary">ایجاد لینک کوتاه</button>
            </form>
        </div>
    </div>
</div>