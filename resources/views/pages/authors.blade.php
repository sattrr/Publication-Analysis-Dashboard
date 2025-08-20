@extends('layouts.app')

@section('content')
<div class="container-fluid py-2">
    <div class="card shadow-sm border-0">
        <div class="card-header bg-white border-0 d-flex justify-content-between align-items-center">
            <h6 class="mb-0 fw-bold">Authors List</h6>
            <form method="GET" action="{{ route('authors') }}" class="d-flex align-items-center">
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
                    <option value="nip" {{ $sort === 'nip' ? 'selected' : '' }}>NIP</option>
                    <option value="id_scopus" {{ $sort === 'id_scopus' ? 'selected' : '' }}>ID Scopus</option>
                    <option value="nama" {{ $sort === 'nama' ? 'selected' : '' }}>Nama</option>
                    <option value="total_publikasi" {{ $sort === 'total_publikasi' ? 'selected' : '' }}>Total Publikasi</option>
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
                    margin: 0 20px;
                }
            </style>

            <div class="table-responsive table-container">
                <table class="table table-sm table-hover align-middle mb-0 table-compact">
                    <thead class="table-light">
                        <tr>
                            <th style="width: 20%;">NIP</th>
                            <th style="width: 20%;">ID Scopus</th>
                            <th style="width: 30%;">Nama</th>
                            <th style="width: 25%;">Total Publikasi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($authors as $author)
                        <tr>
                            <td>{{ $author->nip }}</td>
                            <td>{{ $author->id_scopus }}</td>
                            <td>{{ $author->nama_formatted }}</td>
                            <td>{{ $author->total_publikasi }}</td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center text-muted py-3">Belum ada data penulis.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if($authors->count())
        <div class="card-footer bg-white border-0">
            <div class="d-flex justify-content-center">
                {{ $authors->links('pagination::bootstrap-5') }}
            </div>
        </div>
        @endif
    </div>
</div>
@endsection