<div class="d-flex justify-content-end mb-3">
    <form id="publicationSearchForm" method="GET" action="{{ route('partial') }}" class="d-flex align-items-center">
        @foreach(request()->except(['sort', 'direction', 'search']) as $key => $value)
            <input type="hidden" name="{{ $key }}" value="{{ $value }}">
        @endforeach
        <input type="text" 
            name="search" 
            value="{{ request('search') }}" 
            class="form-control form-control-sm me-2" 
            style="width: 250px;"
            placeholder="Search ...">
        <select name="sort" class="form-select form-select-sm me-2" style="width: 100px;" onchange="this.form.submit()">
            <option value="tahun" {{ $sort === 'tahun' ? 'selected' : '' }}>Tahun</option>
            <option value="judul" {{ $sort === 'judul' ? 'selected' : '' }}>Judul</option>
            <option value="nama" {{ $sort === 'nama' ? 'selected' : '' }}>Author</option>
            <option value="jenis_publikasi" {{ $sort === 'jenis_publikasi' ? 'selected' : '' }}>Jenis Publikasi</option>
            <option value="nama_jurnal" {{ $sort === 'nama_jurnal' ? 'selected' : '' }}>Nama Jurnal</option>
            <option value="sumber_data" {{ $sort === 'sumber_data' ? 'selected' : '' }}>Sumber</option>
        </select>
        <select name="direction" class="form-select form-select-sm" style="width: 50px;" onchange="this.form.submit()">
            <option value="asc" {{ $direction === 'asc' ? 'selected' : '' }}>⬆</option>
            <option value="desc" {{ $direction === 'desc' ? 'selected' : '' }}>⬇</option>
        </select>
    </form>
</div>
<div class="table-responsive table-container">
    <table class="table table-sm table-hover align-middle mb-0 table-compact w-100">
        <thead class="table-light">
            <tr>
                <th style="width: 28%">Judul</th>
                <th style="width: 14%">Author</th>
                <th style="width: 14%">Jenis Publikasi</th>
                <th style="width: 12%">Nama Jurnal</th>
                <th style="width: 6%">Tautan</th>
                <th style="width: 8%">DOI</th>
                <th style="width: 7%">Tahun</th>
                <th style="width: 10%">Sumber</th>
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

@if($publications->count())
<div class="d-flex justify-content-center mt-3">
    {{ $publications->appends(request()->query())->links('pagination::bootstrap-5') }}
</div>
@endif

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
        font-size: 0.6rem;
        padding: 0.45rem 0.6rem;
        vertical-align: middle;
    }

    .table-compact tbody td {
        white-space: normal;
        word-break: break-word;
        font-size: 0.85rem;
        padding: 0.45rem 0.6rem;
        vertical-align: top;
    }

    .table-container {
        max-height: 40vh;
        overflow-y: auto;
        overflow-x: hidden;
        margin: 0;
    }
</style>