@extends('layouts.app')

@section('content')
<div class="container-fluid py-2">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white border-0">
            <h6 class="mb-0 fw-bold">Daftar Publikasi</h6>
        </div>
        <div class="card-body p-0">
            <style>
                .table-compact {
                    table-layout: fixed;
                    width: 100%;
                }
                .table-compact thead th {
                    white-space: nowrap;
                    overflow: hidden;
                    text-overflow: ellipsis;
                    font-size: 0.75rem;
                    padding: 0.4rem 0.5rem;
                    vertical-align: middle;
                }
                .table-compact tbody td {
                    white-space: normal;
                    word-break: break-word;
                    font-size: 0.85rem;
                    padding: 0.4rem 0.5rem;
                    vertical-align: top;
                }
                .table-container {
                    max-height: 500px;
                    overflow-y: auto;
                    margin: 0 20px;
                }
            </style>

            <div class="table-responsive table-container">
                <table class="table table-sm table-hover align-middle mb-0 table-compact">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 35%">Judul</th>
                            <th style="width: 15%">Author</th>
                            <th style="width: 10%">Jenis Publikasi</th>
                            <th style="width: 10%">Nama Jurnal</th>
                            <th style="width: 5%">Tautan</th>
                            <th style="width: 10%">DOI</th>
                            <th style="width: 5%">Tahun</th>
                            <th style="width: 5%">Sumber</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($publications as $publication)
                        <tr>
                            <td>{{ $publication->judul_formatted }}</td>
                            <td>{{ $publication->nama_formatted }}</td>
                            <td>{{ $publication->jenis_publikasi_formatted }}</td>
                            <td>{{ $publication->nama_jurnal_formatted }}</td>
                            <td>
                                @if($publication->tautan)
                                    <a href="{{ $publication->tautan }}" target="_blank">Link</a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
                            <td>{{ $publication->doi ?? '-' }}</td>
                            <td>{{ $publication->tahun }}</td>
                            <td>{{ $publication->sumber_data}}</td>
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
            <div class="d-flex justify-content-center">
                {{ $publications->links('pagination::bootstrap-5') }}
            </div>
        </div>
        @endif
    </div>
</div>
@endsection