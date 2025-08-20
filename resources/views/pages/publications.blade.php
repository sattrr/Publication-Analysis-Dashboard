@extends('layouts.app')

@section('content')
<div class="container-fluid py-2">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
            <h6 class="mb-0 fw-bold">Publications List</h6>
            <form method="GET" action="{{ route('publications') }}" class="d-flex align-items-center">
                @foreach(request()->except(['sort', 'direction']) as $key => $value)
                    <input type="hidden" name="{{ $key }}" value="{{ $value }}">
                @endforeach
                <input type="text" 
                    name="search" 
                    value="{{ request('search') }}" 
                    class="form-control form-control-sm me-2" 
                    style="width: 300px;"
                    placeholder="Search ...">
                <select name="sort" class="form-select form-select-sm me-2" style="width: 140px;" onchange="this.form.submit()">
                    <option value="tahun" {{ $sort === 'tahun' ? 'selected' : '' }}>Tahun</option>
                    <option value="judul" {{ $sort === 'judul' ? 'selected' : '' }}>Judul</option>
                    <option value="nama" {{ $sort === 'nama' ? 'selected' : '' }}>Author</option>
                    <option value="jenis_publikasi" {{ $sort === 'jenis_publikasi' ? 'selected' : '' }}>Jenis Publikasi</option>
                    <option value="nama_jurnal" {{ $sort === 'nama_jurnal' ? 'selected' : '' }}>Nama Jurnal</option>
                    <option value="sumber_data" {{ $sort === 'sumber_data' ? 'selected' : '' }}>Sumber</option>
                </select>
                <select name="direction" class="form-select form-select-sm" style="width: 60px;" onchange="this.form.submit()">
                    <option value="asc" {{ $direction === 'asc' ? 'selected' : '' }}>⬆</option>
                    <option value="desc" {{ $direction === 'desc' ? 'selected' : '' }}>⬇</option>
                </select>
            </form>
        </div>
        <div class="card-body p-0">
            <style>
                .table-compact {
                    table-layout: fixed;
                    width: 100%;
                }
                .table-compact thead th {
                    position: sticky;
                    top: 0;
                    background-color: #f8f9fa;
                    z-index: 10;
                    white-space: nowrap;
                    overflow: hidden;
                    text-overflow: ellipsis;
                    font-size: 0.9rem;
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
                    height: 70dvh;
                    overflow-y: auto;
                    margin: 0;
                    padding: 1%;
                }
            </style>
            <div class="table-responsive table-container">
                <table class="table table-sm table-hover align-middle mb-0 table-compact">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 30%">Judul</th>
                            <th style="width: 15%">Author</th>
                            <th style="width: 10%">Jenis Publikasi</th>
                            <th style="width: 10%">Nama Jurnal</th>
                            <th style="width: 5%">Tautan</th>
                            <th style="width: 8%">DOI</th>
                            <th style="width: 5%">Tahun</th>
                            <th style="width: 7%">Sumber</th>
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