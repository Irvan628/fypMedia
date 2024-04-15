<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>test data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">

</head>

<body class="bg-light">
    <main class="container">
        
        <!-- START FORM -->
        <form id="articleForm" action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="container mt-6">
                <div class="input-group input-group-lg mt-4">
                    <span class="input-group-text" id="inputGroup-sizing-lg">Judul</span>
                    <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" name="judul" id="judul">
                </div>
                      
                <div class="input-group input-group-lg mt-4">
                    <span class="input-group-text" id="inputGroup-sizing-lg">Deskripsi</span>
                    <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" name="deskripsi" id="deskripsi">
                </div>
        
                <div class="input-group input-group-lg mt-4">
                    <span class="input-group-text" id="inputGroup-sizing-lg">Nama Penulis</span>
                    <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" name="nama_penulis" id="nama_penulis">
                </div>
        
                <div class="input-group input-group-lg mt-4">
                    <span class="input-group-text" id="inputGroup-sizing-lg">Editor</span>
                    <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" name="editor" id="editor">
                </div>
        
                <div class="mb-3">
                    <label for="formFile" class="form-label">Foto Pendukung</label>
                    <input class="form-control" type="file" id="gambar" name="gambar">
                </div>    
                    
                <input class="btn btn-primary" type="submit" value="Submit">
                <input type="text" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-lg" name="judul" id="judul">

            </div>
        </form>
        
        <!-- AKHIR FORM -->

        <!-- START DATA -->
        <div class="my-3 p-3 bg-body rounded shadow-sm">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th class="col-md-1">No</th>
                        <th class="col-md-3">Gambar</th>
                        <th class="col-md-2">Judul</th>
                        <th class="col-md-2">Deskripsi</th>
                        <th class="col-md-2">Nama Penulis</th>
                        <th class="col-md-2">Editor</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($data as $index => $artikel)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>
                            @if(isset($artikel['gambar']))
                            <img src="{{ asset('storage/' . $artikel['gambar']) }}" alt="Gambar Artikel" style="max-width: 100px;">
                            @else
                            No Image
                            @endif
                        </td>
                        <td>{{ $artikel['judul'] ?? '' }}</td>
                        <td>{{ $artikel['deskripsi'] ?? '' }}</td>
                        <td>{{ $artikel['nama_penulis'] ?? '' }}</td>
                        <td>{{ $artikel['editor'] ?? '' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
        <!-- AKHIR DATA -->
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-u1OknCvxWvY5kfmNBILK2hRnQC3Pr17a+RTT6rIHI7NnikvbZlHgTPOOmMi466C8" crossorigin="anonymous">
    </script>

</body>

</html>