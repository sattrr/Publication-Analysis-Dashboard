@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    <div class="container-fluid py-4">
        <div class="row">
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Publications</p>
                                    <h5 class="font-weight-bolder">
                                        {{ number_format($totalPublications) }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                                    <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Authors</p>
                                    <h5 class="font-weight-bolder">
                                        {{ number_format($totalAuthors) }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-danger shadow-danger text-center rounded-circle">
                                    <i class="ni ni-world text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Journals</p>
                                    <h5 class="font-weight-bolder">
                                        {{ number_format($totalJournals) }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-success shadow-success text-center rounded-circle">
                                    <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-body p-3">
                        <div class="row">
                            <div class="col-8">
                                <div class="numbers">
                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">Topics</p>
                                    <h5 class="font-weight-bolder">
                                        {{ number_format($totalTopics) }}
                                    </h5>
                                </div>
                            </div>
                            <div class="col-4 text-end">
                                <div class="icon icon-shape bg-gradient-warning shadow-warning text-center rounded-circle">
                                    <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <div class="row mt-4">
                <div class="col-12 mb-lg-0 mb-4">
                    <div class="card z-index-2 h-100">
                        <div class="card-header pb-0 pt-3 bg-transparent">
                            <h6 class="text-capitalize">Publication Trends Over Time</h6>
                            <p class="text-sm mb-0">
                                <i class="fa fa-arrow-up text-success"></i>
                            </p>
                        </div>
                        <div class="card-body p-3">
                            <div class="chart">
                                <canvas id="chart-line"
                                    class="chart-canvas"
                                    data-years='@json($years)'
                                    data-totals='@json($totals)'
                                    height="100">
                                </canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <div class="row mt-4">
            <div class="col-lg-7 mb-lg-0 mb-4">
                <div class="card">
                    <div class="card-header pb-0 p-3">
                        <div class="d-flex justify-content-between">
                            <h6 class="mb-2">Topic Trends</h6>
                        </div>
                    </div>
                    <div class="card-body p-3">
                        <div style="width: 100%; height: 300px;">
                            <canvas id="topTopicsChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
            <div class="col-lg-5">
                <div class="card">
                    <div class="card-header pb-0 p-3">
                        <h6 class="mb-0">Topic Categories</h6>
                    </div>
                    <div class="card-body p-3">
                        <div class="d-flex flex-column align-items-center justify-content-center text-center">
                            <div style="width: 100%; max-width: 300px; height: 300px;">
                                <canvas id="domainChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @include('layouts.footers.auth.footer')
    </div>
    <div class="modal fade" id="publicationModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h6 class="modal-title">Daftar Publikasi <span id="pubYear"></span></h6>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body" id="publicationContent">
                    <div class="text-center py-3">
                        <div class="spinner-border text-primary" role="status"></div>
                        <p class="mt-2">Memuat data...</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('js')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
    function loadPublicationPartial(url) {
        fetch(url, {
            headers: {
                "X-Requested-With": "XMLHttpRequest"
            }
        })
        .then(res => res.text())
        .then(html => {
            document.getElementById("publicationContent").innerHTML = html;
        })
        .catch(err => {
            document.getElementById("publicationContent").innerHTML =
                `<p class="text-danger">Gagal memuat data publikasi.</p>`;
        });
    }

    document.addEventListener('click', function(e){
        const link = e.target.closest('#publicationContent .pagination a');
        if (!link) return;
        e.preventDefault();
        const url = link.href + (link.href.includes('?') ? '&' : '?') + 'partial=1';
        loadPublicationPartial(url);
    });

    document.addEventListener('DOMContentLoaded', function () {
        const canvas = document.getElementById('chart-line');
        if (!canvas) return;

        const years = JSON.parse(canvas.getAttribute('data-years'));
        const totals = JSON.parse(canvas.getAttribute('data-totals'));

        const ctx = canvas.getContext('2d');
        const gradient = ctx.createLinearGradient(0, 230, 0, 50);
        gradient.addColorStop(1, 'rgba(75, 192, 192, 0.2)');
        gradient.addColorStop(0.2, 'rgba(75, 192, 192, 0.0)');
        gradient.addColorStop(0, 'rgba(75, 192, 192, 0)');

        new Chart(ctx, {
            type: 'line',
            data: {
                labels: years,
                datasets: [{
                    label: 'Jumlah Publikasi',
                    data: totals,
                    borderColor: 'rgba(75, 192, 192, 1)',
                    backgroundColor: gradient,
                    tension: 0.4,
                    fill: true,
                    borderWidth: 2,
                    pointRadius: 5,
                    pointHoverRadius: 7,
                    pointBackgroundColor: 'rgba(75, 192, 192, 1)'
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: { display: true },
                    tooltip: { enabled: true }
                },
                scales: {
                    y: { beginAtZero: true }
                },
                onClick: (evt, activeEls) => {
                    if (activeEls.length > 0) {
                        let chart = activeEls[0].element.$context.chart;
                        let index = activeEls[0].index;
                        let year = chart.data.labels[index];

                        document.getElementById("pubYear").innerText = `(${year})`;

                        let modal = new bootstrap.Modal(document.getElementById("publicationModal"));
                        modal.show();

                        fetch(`/publications?year=${year}&partial=1`, {
                            headers: {
                                "X-Requested-With": "XMLHttpRequest"
                            }
                        })
                        .then(res => res.text())
                        .then(html => {
                            document.getElementById("publicationContent").innerHTML = html;
                        })
                        .catch(err => {
                            document.getElementById("publicationContent").innerHTML =
                                `<p class="text-danger">Gagal memuat data publikasi.</p>`;
                        });
                    }
                }
            }
        });
    });

   document.addEventListener("DOMContentLoaded", function () {
        const labels = JSON.parse(`@json($topicLabels ?? [])`);
        const counts = JSON.parse(`@json($topicCounts ?? [])`);

        if (!Array.isArray(labels) || !Array.isArray(counts) || labels.length === 0) {
            console.warn("Data chart kosong, chart tidak akan digambar.");
            return;
        }

        const canvas = document.getElementById('topTopicsChart');
        if (!canvas) return;

        const ctx = canvas.getContext('2d');
        new Chart(ctx, {
            type: 'bar',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Topic Trends',
                    data: counts,
                    backgroundColor: [
                        '#FF6384', '#FF9F40', '#FFCD56',
                        '#4BC0C0', '#36A2EB', '#9966FF',
                        '#C9CBCF', '#F67019', '#00A950', '#8E44AD'
                    ],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    x: {
                        ticks: {
                            maxRotation: 0,
                            minRotation: 0,
                            callback: function (value, index) {
                                let label = this.getLabelForValue(value);
                                return label.length > 10 ? label.substr(2, 3) + '…' : label;
                            }
                        }
                    },
                    y: {
                        type: 'logarithmic',
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return Number(value.toString());
                            }
                        }
                    }
                }
            }
        });
    });
    
    document.addEventListener("DOMContentLoaded", function () {
        const domainLabels = JSON.parse('{!! $domainLabels !!}');
        const domainValues = JSON.parse('{!! $domainValues !!}');

        const ctx = document.getElementById('domainChart').getContext('2d');
        new Chart(ctx, {
            type: 'doughnut',
            data: {
                labels: domainLabels,
                datasets: [{
                    data: domainValues,
                    backgroundColor: [
                        '#ff6384','#36a2eb','#ffcd56','#4bc0c0','#9966ff','#ff9f40'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'bottom',
                        labels: {
                            boxWidth: 15,
                            padding: 15
                        }
                    }
                }
            }
        });
    });
</script>
@endpush