<div class="table-responsive table-container">
    <table class="table table-sm table-hover align-middle mb-0 table-compact w-100">
        <thead class="table-light">
            <tr>
                <th style="width: 35%">Judul</th>
                <th style="width: 15%">Author</th>
                <th style="width: 10%">Jenis Publikasi</th>
                <th style="width: 10%">Nama Jurnal</th>
                <th style="width: 5%">Tautan</th>
                <th style="width: 5%">DOI</th>
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
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        font-size: 0.8rem;
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
        max-height: 65vh;
        overflow-y: auto;
        overflow-x: hidden;
        margin: 0;
    }
</style>