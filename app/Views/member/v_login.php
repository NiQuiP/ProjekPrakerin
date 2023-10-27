<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
</head>

<body>
    <div class="container mt-5 col-5">
        <div class="card">
            <div class="card-header bg-primary text-white">
                LOGIN
            </div>
            <div class="card-body">
                <form action="<?= base_url('member/login') ?>" method="POST">
                    <?php if (session()->getFlashdata("error")) { ?>
                        <div class="alert alert-danger">
                            <?php echo session()->getFlashdata('error') ?>
                        </div>
                    <?php }
                    if (session()->getFlashdata('success')) { ?>
                        <div class="alert alert-success">
                            <?= session()->getFlashdata('success') ?>
                        </div>
                    <?php } ?>
                    <div class="mb-3">
                        <label for="inputUsername" class="form-label">
                            Username
                        </label>
                        <input type="text" name="member_username" class="form-control" id="inputUsername"
                            placeholder="Masukkan Username" value="<?= session()->getFlashdata('member_username') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="inputEmail" class="form-label">
                            Email
                        </label>
                        <input type="email" name="member_email" class="form-control" id="inputEmail"
                            placeholder="Masukkan Email" value="<?= session()->getFlashdata('member_email') ?>">
                    </div>
                    <div class="mb-3">
                        <label for="inputPassword" class="form-label">
                            Password
                        </label>
                        <input type="password" name="member_password" class="form-control" id="inputPassword"
                            placeholder="Masukkan Password">
                    </div>
                    <div class="mb-3">
                        <input type="submit" name="login" class="btn btn-primary" value="LOGIN">
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

</html>