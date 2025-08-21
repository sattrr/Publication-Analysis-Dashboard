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
                    font-size: 0.9rem !important;
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
                    max-height: 70dvh;
                    overflow-y: auto;
                    margin: 0;
                    padding: 1%;
                    min-width: 0;
                    width: 100%;
                }
                .table-compact.table-sm th {
                    font-size: 0.9rem !important;
                }
                .table-compact.table-sm td {
                    font-size: 0.85rem !important;
                }
                .author-link {
                    color: #7e7e7eff;
                    text-decoration: none;
                    transition: color 0.2s;
                }

                .author-link:hover {
                    color: #e26d29ff;
                }
            </style>
            
        <div class="card-body p-0" style="position: relative;">
            <div class="table-container" style="overflow-y: auto; max-height: 70vh;">
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
                            <td>
                                @if($author->total_publikasi > 0)
                                    <a href="javascript:void(0)" class="author-link fw-bold" onclick="openPublicationModal('{{ $author->nip }}')">
                                        {{ $author->total_publikasi }}
                                    </a>
                                @else
                                    <span class="text-muted">-</span>
                                @endif
                            </td>
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

@push('modals')
<div class="modal fade" id="publicationModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Author Publications</h5>
                <button type="button" class="modal-close-x" data-bs-dismiss="modal" aria-label="Close">×</button>
            </div>
            <div class="modal-body" id="publicationContent">
                <p class="text-center text-muted">Loading...</p>
            </div>
        </div>
    </div>
</div>

<style>
    .modal-close-x {
        background: transparent;
        border: none;
        font-size: 2rem;
        font-weight: 300;
        line-height: 1;
        color: #000;
        cursor: pointer;
        padding: 0;
    }
    .modal-close-x:hover {
        color: #ddddddff;
    }
    .modal { z-index: 2000 !important; }
    .modal-backdrop { z-index: 1999 !important; }
</style>
@endpush

@push('js')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    let activeNip = null;

    function loadPublicationPartial(url) {
        fetch(url, {
            headers: { "X-Requested-With": "XMLHttpRequest" }
        })
        .then(res => res.text())
        .then(html => {
            document.getElementById("publicationContent").innerHTML = html;
        })
        .catch(err => {
            document.getElementById("publicationContent").innerHTML =
                `<p class="text-danger">Gagal memuat data publikasi.</p>`;
            console.error(err);
        });
    }

    function openPublicationModal(nip) {
        console.log('Opening modal for NIP:', nip);
        activeNip = nip;
        const modal = new bootstrap.Modal(document.getElementById('publicationModal'));
        modal.show();

        document.getElementById("publicationContent").innerHTML = '<p class="text-center text-muted">Loading...</p>';

        let url = "{{ route('partial') }}" + '?nip=' + encodeURIComponent(nip) + '&partial=1&_=' + new Date().getTime();
        console.log('Fetching URL:', url);
        loadPublicationPartial(url);
    }

    document.addEventListener('click', function(e) {
        const link = e.target.closest('#publicationContent .pagination a');
        if (!link) return;
        e.preventDefault();

        const url = new URL(link.href);
        url.searchParams.set('nip', activeNip);
        url.searchParams.set('partial', 1);
        loadPublicationPartial(url.toString());
    });

    document.addEventListener('submit', function(e) {
        const form = e.target.closest('#publicationSearchForm');
        if (!form) return;
        e.preventDefault();

        const formData = new FormData(form);
        formData.set('nip', activeNip);
        formData.set('partial', 1);

        const url = form.action + '?' + new URLSearchParams(formData).toString();
        loadPublicationPartial(url);
    });
</script>
@endpush