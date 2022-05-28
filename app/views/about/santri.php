<div class="container mt-5">
    <div class="row">
        <div class="col-lg-6"></div>
        <?php flasher::flash() ?>
    </div>
    <div class="row mb-3">
        <div class="col-lg-6">
            <button class="btn btn-primary mb-2 tambah" type="button" data-toggle="modal" data-target="#formModal">Tambah
                Santri</button>

        </div>
    </div>
    <div class="row mb-3">
        <div class="col-lg-6">
            <form action="<?= BASEURL ?>about/cari" method="post">

                <div class="input-group mb-3">
                    <input type="text" class="form-control" placeholder="Cari santri" name="keyword" id="keyword" aria-label="Recipient's username" aria-describedby="button-addon2" autocomplete="off">
                    <div class="input-group-append">
                        <button class="btn btn-outline-primary" type="submit" id="cari">Cari</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">

            <h3>Daftar santri</h3>

            <?php foreach ($data['santri'] as $santri) : ?>
                <ul class="list-group">
                    <li class="list-group-item ">
                        <?= $santri['username'] ?>
                        <a href="<?= BASEURL ?>about/hapus/<?= $santri['id'] ?>" class="badge badge-danger badge-pill float-right ml-2" onclick="return confirm('yakin ?')">hapus</a>
                        <a href="<?= BASEURL ?>about/ubah/<?= $santri['id'] ?>" " data-toggle=" modal" data-target="#formModal" class="badge badge-warning badge-pill float-right ml-2 ubah" data-id='<?= $santri['id'] ?>'>edit</a>
                        <a href="<?= BASEURL ?>about/detail/<?= $santri['id'] ?>" class="badge badge-primary badge-pill float-right ml-2">detail</a>
                    </li>
                </ul>

            <?php endforeach ?>
        </div>
    </div>
</div>
<div id="formModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="judul" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="judul">Tambah Santri</h5>
                <button class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="<?= BASEURL ?>about/tambah">
                    <input type="hidden" name="id" id="id">
                    <div class="form-group">
                        <label for="username">username</label>
                        <input id="username" class="form-control" type="text" name="username">
                    </div>
                    <div class="form-group">
                        <label for="level">Password</label>
                        <input id="password" class="form-control" type="text" name="password">
                    </div>
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary" type="submit">Tambah data</button>

                </form>
            </div>
        </div>
    </div>
</div>