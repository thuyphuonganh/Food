document.addEventListener('DOMContentLoaded', function () {
    const canvas = document.getElementById('monthlyRevenueChart');
    if (canvas) {
        let labels = JSON.parse(canvas.getAttribute('data-labels') || '[]');
        const values = JSON.parse(canvas.getAttribute('data-values') || '[]');

        // Không cần map thành string nếu bạn chỉ muốn số (1, 2, 3, ...)
        const ctx = canvas.getContext('2d');
        new Chart(ctx, {
            type: 'line',
            data: {
                labels: labels,
                datasets: [{
                    label: 'Doanh thu',
                    data: values,
                    borderColor: 'rgba(54, 162, 235, 1)',
                    backgroundColor: 'rgba(54, 162, 235, 0.2)',
                    fill: true,
                    tension: 0.4,
                    pointBackgroundColor: 'rgba(54, 162, 235, 1)',
                    pointBorderColor: '#fff',
                    pointHoverBackgroundColor: '#fff',
                    pointHoverBorderColor: 'rgba(54, 162, 235, 1)',
                }]
            },
            options: {
                responsive: true,
                interaction: {
                    mode: 'index',
                    intersect: false,
                },
                plugins: {
                    tooltip: {
                        enabled: true,
                        callbacks: {
                            title: function(tooltipItems) {
                                // Giữ nguyên số tháng, không đổi qua tiếng Anh
                                return 'Tháng ' + tooltipItems[0].label;
                            },
                            label: function(tooltipItem) {
                                let value = tooltipItem.raw;
                                return 'Doanh thu: ' + value.toLocaleString('vi-VN') + '₫';
                            }
                        }
                    },
                    legend: {
                        display: false
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: function(value) {
                                return value.toLocaleString('vi-VN') + '₫';
                            }
                        },
                        title: {
                            display: true,
                            text: 'Doanh thu (VNĐ)'
                        }
                    },
                    x: {
                        title: {
                            display: true,
                            text: 'Tháng'
                        },
                        ticks: {
                            callback: function(value, index, values) {
                                return labels[index]; // Hiển thị đúng số tháng
                            }
                        }
                    }
                }
            }
        });
    }
});
