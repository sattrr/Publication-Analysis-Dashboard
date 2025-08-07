@php use Illuminate\Support\Str; @endphp

@extends('layouts.app')

@section('content')
<div class="container-fluid py-2">
    <div class="card">
        <div class="card-header pb-0">
            <h6>Daftar Publikasi</h6>
        </div>
        <div class="card-body p-2">
            <div class="table-responsive my-2 mx-3">
                <table class="table table-sm table-striped table-hover small w-100">
                    <thead class="thead-light">
                        <tr>
                            <th style="width: 22%;">Judul</th>
                            <th style="width: 14%;">Author</th>
                            <th style="width: 10%;">Jenis Publikasi</th>
                            <th style="width: 12%;">Nama Jurnal</th>
                            <th style="width: 8%;">Tautan</th>
                            <th style="width: 10%;">DOI</th>
                            <th style="width: 6%;">Tahun</th>
                            <th style="width: 8%;">Sumber</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($publications as $publication)
                        <tr>
                            <td>
                                <div class="text-truncate" style="width: 100%;">
                                    {{ Str::limit($publication->judul, 60) }}
                                </div>
                            </td>
                            <td>
                                <div class="text-truncate" style="width: 100%;">
                                    {{ Str::limit($publication->nama, 30) }}
                                </div>
                            </td>
                            <td>{{ $publication->jenis_publikasi }}</td>
                            <td>
                                <div class="text-truncate" style="width: 100%;">
                                    {{ Str::limit($publication->nama_jurnal, 40) }}
                                </div>
                            </td>
                            <td>
                                @if($publication->tautan)
                                    <a href="{{ $publication->tautan }}" target="_blank">Link</a>
                                @else
                                    -
                                @endif
                            </td>
                            <td>{{ Str::limit($publication->doi ?? '-', 18) }}</td>
                            <td>{{ $publication->tahun }}</td>
                            <td>{{ $publication->sumber_data }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-3">Belum ada data publikasi.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div class="text-sm text-muted mt-3 ms-2">
                Menampilkan {{ $publications->firstItem() }}–{{ $publications->lastItem() }} dari {{ $publications->total() }} data publikasi
            </div>

            <div class="d-flex justify-content-center mt-2">
                {{ $publications->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>
</div>
@endsection