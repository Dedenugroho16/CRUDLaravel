<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Tambah Data Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    </head>
    <body>
        <h1 class="text-center mb-5">Tambah Data Admin</h1>

        <div class="container">
            <div class="row justify-content-center">
                <div class="col-8">
                    <div class="card">
                        <div class="card-body">
                            <form action="/insertDataAdmin" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="nama" class="form-label">Nama Lengkap</label>
                                    <input type="text" name="nama" class="form-control" id="nama" autocomplete="off">
                                </div>
                                <div class="mb-3">
                                    <select class="form-select" name="jenisKelamin" aria-label="Default select example">
                                        <option selected>Jenis Kelamin</option>
                                        <option value="laki-laki">laki-laki</option>
                                        <option value="perempuan">perempuan</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="telpon" class="form-label">Nomor Telpon</label>
                                    <input type="number" name="noTelpon" class="form-control" id="telpon">
                                </div>
                                <div class="mb-3">
                                    <label for="foto" class="form-label">Masukan Foto</label>
                                    <input type="file" name="foto" id="foto" class="form-control">
                                </div>
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
    </body>
</html>