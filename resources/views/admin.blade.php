<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Data Admin</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    </head>
    <body>
        <h1 class="text-center mb-5">Data Admin</h1>

        <div class="container">
            <a href="/tambahDataAdmin" class="btn btn-success mb-2">Tambah Data Admin</a>

            <div class="row g-3 align-items-center">
                <div class="col-auto mb-2">
                <form action="/admin" method="GET">
                    <input type="search" id="search" name="search" class="form-control" aria-describedby="passwordHelpInline" placeholder="Search...">
                </form>
                </div>

                <div class="col-auto mb-2">
                    <a href="exportpdf" class="btn btn-info">Export PDF</a>
                </div>

                <div class="col-auto mb-2">
                    <a href="exportexcel" class="btn btn-success">Export Excel</a>
                </div>

                <div class="col-auto mb-2">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        Import Data
                    </button>
                </div>
    
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">Modal title</h1>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="/importexcel" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                        <input type="file" name="file" required>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </div>
            </form>
        </div>
    </div>

            </div>

            <div class="row">
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th scope="col">No.</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Foto</th>
                        <th scope="col">Jenis Kelamin</th>
                        <th scope="col">No Telpon</th>
                        <th scope="col">Dibuat Pada</th>
                        <th scope="col">Diupdate Pada</th>
                        <th scope="col">Aksi</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php
                            $no = 1
                        @endphp
                        @foreach ($data as $index => $row)
                            <tr>
                                <td scope="row">{{ $index + $data->firstItem() }}</td>
                                <td>{{ $row -> nama }}</td>
                                <td><img src="{{ asset('foto/'.$row->foto) }}" width="100px"></td>
                                <td>{{ $row -> jenisKelamin }}</td>
                                <td>0{{ $row -> noTelpon }}</td>
                                <td>{{ $row -> created_at->diffForHumans() }}</td>
                                <td>{{ $row -> updated_at }}</td>
                                <td>
                                    <a href="/tampilkanData/{{ $row ->id }}" class="btn btn-primary">Edit</a>
                                    <a href="#" class="btn btn-danger delete" data-id="{{ $row->id }}" data-nama="{{ $row->nama }}">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $data->links() }}
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.1/jquery.min.js" integrity="sha512-aVKKRRi/Q/YV+4mjoKBsE4x3H+BkegoM/em46NNlCqNTmUYADjBbeNefNxYV7giUp0VxICtqdrbqU7iVaeZNXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    </body>
    <script>
        $('.delete').click(function(){
            var adminId = $(this).attr('data-id');
            var nama = $(this).attr('data-nama');
            swal({
                title: "Yakin nih pengen dihapus?",
                text: "Anda akan menghapus data dengan nama " + nama,
                icon: "warning",
                buttons: true,
                dangerMode: true,
                })
                .then((willDelete) => {
                if (willDelete) {
                    window.location = "/delete/" + adminId;
                    swal("Data anda telah dihapus!", {
                    icon: "success",
                    });
                } else {
                    swal("Data batal dihapus!");
                }
            });
        });
    </script>
    <script>
    @if(Session::has('success'))
        toastr.success("{{ Session::get('success') }}")
    @endif
    </script>
</html>