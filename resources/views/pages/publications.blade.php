@extends('layouts.app')

@section('content')
<div class="container-fluid py-2">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white border-0">
            <h6 class="mb-0 fw-bold">Daftar Publikasi</h6>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-sm table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Judul</th>
                            <th>Author</th>
                            <th>Jenis Publikasi</th>
                            <th>Nama Jurnal</th>
                            <th>Tautan</th>
                            <th>DOI</th>
                            <th>Tahun</th>
                            <th>Sumber</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($publications as $publication)
                        <tr>
                            <td>{{ Str::limit($publication->judul, 60) }}</td>
                            <td>{{ Str::limit($publication->nama, 30) }}</td>
                            <td>{{ $publication->jenis_publikasi }}</td>
                            <td>{{ Str::limit($publication->nama_jurnal, 40) }}</td>
                            <td>
                                @if($publication->tautan)
                                    <a href="{{ $publication->tautan }}" target="_blank">Link</a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>{{ Str::limit($publication->doi ?? '-', 18) }}</td>
                            <td>{{ $publication->tahun }}</td>
                            <td>{{ $publication->sumber_data }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center text-muted py-3">Belum ada data publikasi.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if($publications->count())
        <div class="card-footer bg-white border-0">
            <div class="d-flex flex-column flex-sm-row justify-content-between align-items-sm-center">
                <small class="text-muted">
                    Menampilkan {{ $publications->firstItem() }}–{{ $publications->lastItem() }} dari {{ $publications->total() }} data publikasi
                </small>
                <div class="mt-2 mt-sm-0">
                    {{ $publications->links('pagination::bootstrap-5') }}
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection