<!--Content Header (Page header)-->
<div class="content-header row align-items-center m-0">
    <nav aria-label="breadcrumb" class="col-sm-4 order-sm-last mb-3 mb-sm-0 p-0 ">
        <ol class="breadcrumb d-inline-flex font-weight-600 fs-13 bg-white mb-0 float-sm-right">
            <li class="breadcrumb-item"><a href="#">Admin</a></li>
            <li class="breadcrumb-item active">User Management</li>
        </ol>
    </nav>
    <div class="col-sm-8 header-title p-0">
        <div class="media">
            <div class="header-icon text-success mr-3"><i class="typcn typcn-group"></i></div>
            <div class="media-body">
                <h1 class="font-weight-bold"><?= $title; ?></h1>
                <small>Admin</small>
            </div>
        </div>
    </div>
</div>
<!--/.Content Header (Page header)-->
<div class="body-content">
    <div class="row">
        <ul class="nav nav-pills" id="pills-tab" role="tablist" style="width: 100%">
            <li class="nav-item col-lg-2">
                <a class="nav-link p-0 active" data-toggle="pill" href="#user" role="tab">
                    <!--Active users indicator-->
                    <div class="p-2 bg-success text-black rounded mb-3 p-3 shadow-sm text-center position-relative overflow-hidden">
                        <i class="decorative-icon fas fa-user opacity-25 fa-5x animated infinite pulse slower"></i>
                        <pre class="text-white rounded p-2 mb-0">Data User</pre>
                    </div>
                </a>
            </li>
            <li class="nav-item col-lg-2">
                <a class="nav-link p-0" data-toggle="pill" href="#role" role="tab">
                    <!--Active users indicator-->
                    <div class="p-2 bg-warning text-black rounded mb-3 p-3 shadow-sm text-center position-relative overflow-hidden">
                        <i class="decorative-icon fas fa-user-tag opacity-25 fa-5x animated infinite pulse slower"></i>
                        <pre class="text-white rounded p-2 mb-0">Data Role</pre>
                    </div>
                </a>
            </li>
        </ul>
    </div>

    <div class="tab-content" id="pills-tabContent">
        <div class="tab-pane fade show active" id="user" role="tabpanel">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fs-17 font-weight-600 mb-0">Data User</h6>
                        </div>
                        <div class="text-right">
                            <div class="actions">
                                <button class="btn btn-success" data-toggle="modal" data-target="#addUser">
                                    <i class="typcn typcn-user-add-outline"></i>&nbsp;Tambah Data User
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table display table-bordered table-striped table-hover basic2">
                            <thead>
                                <tr>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Role</th>
                                    <th>Date Created</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $x = 1; ?>
                                <?php foreach ($data_user as $data) :  ?>
                                    <tr>
                                        <td><?= $data['name']; ?></td>
                                        <td><?= $data['email']; ?></td>
                                        <td><?= $data['role']; ?></td>
                                        <td data-sort="<?= $data['date_created'] ?>"><?= date('d / M / Y', $data['date_created']); ?></td>
                                        <td style="text-align: center">
                                            <a href="#" class="btn btn-warning-soft btn-sm mr-1 edit" data-id="<?= $data['id'] ?>" data-name="<?= $data['name'] ?>" data-email="<?= $data['email'] ?>" data-role="<?= $data['role_id'] ?>">
                                                <i class="ti ti-pencil" style="font-size: 18px"></i>
                                            </a>
                                            <a href="#" class="btn btn-danger-soft btn-sm md-trigger" data-modal="deleteUser<?= $data['id'] ?>"><i class="ti ti-trash" style="font-size: 18px"></i></a>
                                        </td>
                                    </tr>
                                    <?php $x++; ?>
                                <?php endforeach; ?>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="tab-pane fade show" id="role" role="tabpanel">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="fs-17 font-weight-600 mb-0">Data Role</h6>
                        </div>
                        <div class="text-right">
                            <div class="actions">
                                <button class="btn btn-warning text-white" data-toggle="modal" data-target="#addRole">
                                    <i class="typcn typcn-tags"></i>&nbsp;Tambah Data Role
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table display table-bordered table-striped table-hover basic">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Role</th>
                                    <th>Akses</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $x = 1; ?>
                                <?php foreach ($data_role as $data) :  ?>
                                    <?php
                                    $this->db->select('*');
                                    $this->db->from('user_access_menu');
                                    $this->db->join('user_menu', 'user_menu.id = user_access_menu.menu_id');
                                    $this->db->join('user_role', 'user_role.id_role = user_access_menu.role_id');
                                    $this->db->where('role_id', $data['id_role']);
                                    $akses = $this->db->get()->result_array();
                                    ?>
                                    <tr>
                                        <td><?= $x; ?></td>
                                        <td><?= $data['role']; ?></td>
                                        <td>
                                            <?php $y = 1; ?>
                                            <?php foreach ($akses as $acc) :  ?>
                                                <span><?= $y; ?>) <?= $acc['menu']; ?></span><br>
                                                <?php $y++; ?>
                                            <?php endforeach; ?>
                                        </td>
                                        <td style="text-align: center">
                                            <a href="<?= base_url('admin/roleAccess/' . $data['id_role']) ?>" class="btn btn-primary-soft btn-sm"><i class="ti ti-link"></i>&nbsp; Akses</a>
                                            <a href="#" class="btn btn-warning-soft btn-sm mr-1 editRole" data-id="<?= $data['id_role'] ?>" data-role="<?= $data['role'] ?>">
                                                <i class="ti ti-pencil" style="font-size: 18px"></i>
                                            </a>
                                            <a href="#" class="btn btn-danger-soft btn-sm md-trigger" data-modal="deleteRole<?= $data['id_role'] ?>"><i class="ti ti-trash" style="font-size: 18px"></i></a>
                                        </td>
                                    </tr>
                                    <?php $x++; ?>
                                <?php endforeach; ?>
                            </tbody>

                        </table>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
<!--/.body content-->
</div>
<!--/.main content-->

<div class="modal fade" id="addUser" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-600" style="margin-left:auto">Tambah Data User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('admin/add_user') ?>" method="POST" id="add_user">
                    <div class="form-group">
                        <label for="">Full Name</label>
                        <input class="form-control" placeholder="Masukkan Nama" type="text" name="name">
                    </div>
                    <div class="form-group">
                        <label for="">Role</label>
                        <select class="form-control" name="role">
                            <?php foreach ($data_role as $role) : ?>
                                <option value="<?= $role['id_role'] ?>"><?= $role['role']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input class="form-control email" placeholder="Masukkan Email" type="email" name="email">
                        <p class="email_valid"></p>
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input class="form-control" placeholder="Masukkan Password" type="password" name="password" id="password">
                    </div>
                    <div class="form-group">
                        <label for="">Repeat Password</label>
                        <input class="form-control" placeholder="Ulangi Password" type="password" name="password2" id="password2">
                    </div>
                    <p class="message"></p>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success btn-adduser" disabled>Add User</button>
            </div>
            </form>

        </div>
    </div>
</div>
<div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-600" style="margin-left:auto">Edit Data User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="<?= base_url('admin/edit_user') ?>" method="POST" id="edit_user">
                    <input type="hidden" name="id" class="id">
                    <div class="form-group">
                        <label for="">Full Name</label>
                        <input class="form-control name" placeholder="Masukkan Nama" type="text" name="name">
                    </div>
                    <div class="form-group">
                        <label for="">Role</label>
                        <select class="form-control role" name="role">
                            <?php foreach ($data_role as $role) : ?>
                                <option value="<?= $role['id_role'] ?>"><?= $role['role']; ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Email</label>
                        <input class="form-control email" placeholder="Masukkan Email" type="email" name="email" disabled>
                        <p class="email_valid"></p>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-success">Add User</button>
            </div>
            </form>

        </div>
    </div>
</div>
<?php foreach ($data_user as $data) :  ?>
    <div class="md-modal md-effect-1" id="deleteUser<?= $data['id'] ?>" style="width:30%">
        <div class="md-content">
            <h4 class="font-weight-600 mb-0" style="background-color: #BF1E1B;color:white">Warning!</h4>
            <div class="n-modal-body" style="text-align:center ;">
                <p>Apakah Anda Yakin Ingin Menghapus Data Ini?
                    <span style="font-weight:bold"><?= $data['name']; ?> (<?= $data['email']; ?>)</span>
                </p>

                <div class="row">
                    <div class="col-lg-6">
                        <button class="btn btn-danger btn-block" onclick="location.href='<?= base_url('admin/delete_user/' . $data['id']) ?>'">Delete</button>
                    </div>
                    <div class="col-lg-6">
                        <button class="btn btn-success md-close btn-block">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="md-overlay"></div>
<?php endforeach; ?>

<div class="modal fade" id="addRole" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-600" style="margin-left:auto">Tambah Data Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/add_role') ?>" method="POST">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Role</label>
                        <input class="form-control role_valid" placeholder="Masukkan Role" type="text" name="role">
                        <p class="message"></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success btn-addRole">Add Role</button>
                </div>
            </form>

        </div>
    </div>
</div>
<div class="modal fade" id="editRoleModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-600" style="margin-left:auto">Edit Data Role</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="<?= base_url('admin/edit_role') ?>" method="POST">
                <div class="modal-body">
                    <input type="hidden" name="id_role" class="id_role">
                    <div class="form-group">
                        <label for="">Role</label>
                        <input class="form-control role role_valid" placeholder="Masukkan Role" type="text" name="role">
                        <p class="message"></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-success btn-addRole">Edit Role</button>
                </div>
            </form>

        </div>
    </div>
</div>

<?php foreach ($data_role as $data) : ?>
    <div class="md-modal md-effect-1" id="deleteRole<?= $data['id_role'] ?>" style="width:30%">
        <div class="md-content">
            <h4 class="font-weight-600 mb-0" style="background-color: #BF1E1B;color:white">Warning!</h4>
            <div class="n-modal-body" style="text-align:center ;">
                <p>Apakah Anda Yakin Ingin Menghapus Data Ini?
                    <span style="font-weight:bold">(<?= $data['role']; ?>)</span>
                </p>

                <div class="row">
                    <div class="col-lg-6">
                        <button class="btn btn-danger btn-block" onclick="location.href='<?= base_url('admin/delete_role/' . $data['id_role']) ?>'">Delete</button>
                    </div>
                    <div class="col-lg-6">
                        <button class="btn btn-success md-close btn-block">Close</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

<?php endforeach; ?>