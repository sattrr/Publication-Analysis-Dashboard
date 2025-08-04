window.renderPublicationChart = function (years, totals) {
    const canvas = document.getElementById('chart-line');
    if (!canvas) return;

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
                pointRadius: 3
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: true
                }
            },
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
};