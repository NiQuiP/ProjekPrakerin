<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5 col-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                DATA USER
            </div>
            <div class="card-body">
                <div class="mb-3">
                    <label class="form-label">
                        Username
                    </label>
                    <label type="text" class="form-control">
                        <?= session()->get('member_username') ?>
                    </label>
                </div>
                <div class="mb-3">
                    <label class="form-label">
                        Email
                    </label>
                    <label type="email" class="form-control">
                        <?= session()->get('member_email') ?>
                    </label>
                </div>
                <div class="mb-3">
                    <a href="<?= site_url('member/logout') ?>" class="btn btn-primary">
                        LOGOUT
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>