@extends('layouts.app')

@section('content')
<div class="container-fluid py-2">
    <div class="card">
        <div class="card-header pb-0">
            <h6>Daftar Penulis</h6>
        </div>
        <div class="card-body p-2">
            <div class="table-responsive my-2 mx-3">
                <table class="table table-sm table-striped table-hover small w-100">
                    <thead class="thead-light">
                        <tr>
                            <th style="width: 20%;">NIP</th>
                            <th style="width: 20%;">ID Scopus</th>
                            <th style="width: 40%;">Nama</th>
                            <th style="width: 20%;">Total Publikasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($authors as $author)
                        <tr>
                            <td>
                                <div class="text-truncate" style="width: 100%;">
                                    {{ $author->nip }}
                                </div>
                            </td>
                            <td>
                                <div class="text-truncate" style="width: 100%;">
                                    {{ $author->id_scopus }}
                                </div>
                            </td>
                            <td>
                                <div class="text-truncate" style="width: 100%;">
                                    {{ $author->nama }}
                                </div>
                            </td>
                            <td>{{ $author->total_publikasi }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-3">Belum ada data penulis.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="text-sm text-muted mt-3 ms-2">
                Menampilkan {{ $authors->firstItem() }}–{{ $authors->lastItem() }} dari {{ $authors->total() }} data penulis
            </div>

            <div class="d-flex justify-content-center mt-2">
                {{ $authors->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection