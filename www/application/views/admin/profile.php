<div class="content-header row align-items-center m-0">
    <nav aria-label="breadcrumb" class="col-sm-4 order-sm-last mb-3 mb-sm-0 p-0 ">
        <ol class="breadcrumb d-inline-flex font-weight-600 fs-13 bg-white mb-0 float-sm-right">
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item active">My Profile</li>
        </ol>
    </nav>
    <div class="col-sm-8 header-title p-0">
        <div class="media">
            <div class="header-icon text-success mr-3"><i class="typcn typcn-user"></i></div>
            <div class="media-body">
                <h1 class="font-weight-bold"><?= $title; ?></h1>
                <small>Admin</small>
            </div>
        </div>
    </div>
</div>
<div class="body-content">
    <div class="row">
        <div class="col-lg-12">
            <?php $this->session->flashdata('message') ?>
        </div>
        <div class="col-lg-4">
            <div class="card mb-3 mt-2 p-3">
                <div class="media d-flex">
                    <div class="align-left p-1">
                        <a href="#" class="profile-image">
                            <img src="<?= base_url() ?>assets/img/<?= $user['image'] ?>" class="avatar avatar-xl rounded-circle img-border height-100" alt="Card image">
                        </a>
                    </div>
                    <div class="media-body text-left ml-3 mt-4">
                        <h3 class="font-large-1 white"><?= $user['name']; ?></h3>
                    </div>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="mb-0 font-weight-600">Email</h6>
                        </div>
                        <div class="col-auto">
                            <time class="fs-13 font-weight-600 text-muted" datetime="1988-10-24"><?= $user['email']; ?></time>
                        </div>
                    </div>
                    <hr>
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="mb-0 font-weight-600">Role</h6>
                        </div>
                        <div class="col-auto">
                            <time class="fs-13 font-weight-600 text-muted" datetime="2018-10-28"><?= $user['role']; ?></time>
                        </div>
                    </div>
                    <hr>
                    <div class="row align-items-center">
                        <div class="col">
                            <h6 class="mb-0 font-weight-600">Date Created</h6>
                        </div>
                        <div class="col-auto">
                            <span class="fs-13 font-weight-600 text-muted"><?= date('d M Y', $user['date_created']); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-8">
            <div class="card mt-2">
                <div class="card-header">
                    <ul class="nav nav-pills" id="pills-tab" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link p-2 active" data-toggle="pill" href="#profile" role="tab">
                                Profile
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link p-2" data-toggle="pill" href="#password" role="tab">
                                Change Password
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content" id="pills-tabContent">
                    <div class="tab-pane fade show active" id="profile" role="tabpanel">
                        <form action="<?= base_url('admin/edit') ?>" method="POST" enctype="multipart/form-data">
                            <div class="card-body">
                                <h4 class="mb-4" style="font-weight: 600">Edit Profile</h4>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-600">Nama</label>
                                            <input type="text" class="form-control" name="name" value="<?= $user['name'] ?>" required>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-600">Email</label>
                                            <input type="text" class="form-control" name="email" value="<?= $user['email'] ?>" readonly>
                                        </div>
                                    </div>
                                    <div class="col-lg-12">
                                        <div class="form-group">
                                            <label class="font-weight-600">Profile Picture</label>
                                            <input type="file" id="file-1" name="image" class="custom-input-file" accept="image/*" />
                                            <label for="file-1">
                                                <i class="fa fa-upload"></i>
                                                <span class="custom-label">Choose a file…</span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-12" style="text-align: right;">
                                        <button type="submit" class="btn btn-success" style="width: 150px;">Save</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="tab-pane fade show" id="password" role="tabpanel">
                        <form action="<?= base_url('admin/changePassword') ?>" method="POST">
                            <div class="card-body">
                                <h4 class="mb-4" style="font-weight: 600">Change Password</h4>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="font-weight-600">Masukkan Password</label>
                                            <input type="password" class="form-control" name="current_password" id="current_password">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-600">Password Baru</label>
                                            <input type="password" class="form-control" name="new_password" id="new_password">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="font-weight-600">Ulangi Password Baru</label>
                                            <input type="password" class="form-control" name="new_password2" id="new_password2">
                                        </div>
                                    </div>
                                    <p class="message_change"></p>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-12" style="text-align: right;">
                                        <button type="submit" class="btn btn-success btn-changePass" style="width: 150px;">Change Password</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--/.body content-->
</div>
<!--/.main content-->