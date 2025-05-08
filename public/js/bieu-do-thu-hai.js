/**
 * File: daily-revenue-chart.js
 * Chức năng: Xử lý biểu đồ doanh thu theo ngày của từng tháng (Biểu đồ đường, đơn vị VND)
 */

document.addEventListener('DOMContentLoaded', function() {
    initDailyRevenueCharts();
    setupTabEvents();
});

const dailyCharts = {};

/**
 * Thiết lập sự kiện cho các tab
 */
function setupTabEvents() {
    const tabs = document.querySelectorAll('.nav-tabs a[data-toggle="tab"]');
    
    tabs.forEach(tab => {
        tab.addEventListener('click', function(e) {
            e.preventDefault();
            
            // Reset active trên tất cả
            tabs.forEach(t => {
                t.parentElement.classList.remove('active');
                document.querySelector(t.getAttribute('href')).classList.remove('active');
            });
            
            // Active tab vừa click
            this.parentElement.classList.add('active');
            const targetId = this.getAttribute('href');
            document.querySelector(targetId).classList.add('active');
            
            const month = this.dataset.month;
            // Nếu chưa có chart cho tháng này, tạo mới
            if (!dailyCharts[month]) {
                initDailyRevenueChart(month);
            }
        });
    });
}

/**
 * Khởi tạo chart cho tab hiện tại
 */
function initDailyRevenueCharts() {
    const dataContainer = document.getElementById('revenue-data');
    if (!dataContainer) return;
    
    // Lấy tháng hiện tại (1-12)
    const currentMonth = parseInt(dataContainer.dataset.currentMonth) || (new Date().getMonth() + 1);
    initDailyRevenueChart(currentMonth);
}

/**
 * Khởi tạo biểu đồ doanh thu theo ngày cho một tháng
 * @param {number} month 
 */
function initDailyRevenueChart(month) {
    const dataContainer = document.getElementById('revenue-data');
    if (!dataContainer) return;
    
    // dailyRevenue: object { "1":[{day:1,revenue:...},...], "2":[...], ... }
    const dailyRevenueData = JSON.parse(dataContainer.dataset.dailyRevenue || '{}');
    const chartCanvas = document.getElementById(`dailyRevenueChart-${month}`);
    if (!chartCanvas) return;
    
    // Dữ liệu tháng
    const data = dailyRevenueData[month] || [];
    
    // Tạo labels tự động từ 1→số ngày trong tháng
    const year = new Date().getFullYear();
    const totalDays = getDaysInMonth(month, year);
    const labels = Array.from({ length: totalDays }, (_, i) => (i + 1).toString());
    
    // Ghép revenue, nếu ngày không có order thì 0
    const revenues = labels.map(day => {
        const rec = data.find(item => item.day === parseInt(day));
        return rec ? rec.revenue : 0;
    });
    
    const ctx = chartCanvas.getContext('2d');
    // Nếu đã tồn tại chart thì destroy trước
    if (dailyCharts[month]) {
        dailyCharts[month].destroy();
    }
    
    dailyCharts[month] = new Chart(ctx, {
        type: 'line',
        data: {
            labels: labels,
            datasets: [{
                label: `Doanh thu tháng ${month} (VNĐ)`,
                data: revenues,
                borderColor: 'rgba(54, 162, 235, 1)',
                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                fill: false,
                tension: 0.4,
                pointBackgroundColor: 'rgba(54, 162, 235, 1)',
                pointBorderColor: '#fff',
                pointHoverBackgroundColor: '#fff',
                pointHoverBorderColor: 'rgba(54, 162, 235, 1)',
                pointRadius: 4,
                pointHoverRadius: 6
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: {
                intersect: false,
                mode: 'index'
            },
            scales: {
                x: {
                    title: {
                        display: true,
                        text: 'Ngày trong tháng'
                    },
                    grid: {
                        color: 'rgba(0,0,0,0.05)'
                    },
                    ticks: {
                        autoSkip: false,
                        maxRotation: 0,
                        minRotation: 0
                    }
                },
                y: {
                    beginAtZero: true,
                    title: {
                        display: true,
                        text: 'Doanh thu (VNĐ)'
                    },
                    grid: {
                        color: 'rgba(0,0,0,0.05)'
                    },
                    ticks: {
                        callback: function(value) {
                            return value.toLocaleString('vi-VN') + '₫';
                        }
                    }
                }
            },
            plugins: {
                legend: {
                    display: true,
                    position: 'top'
                },
                tooltip: {
                    backgroundColor: 'rgba(0, 0, 0, 0.8)',
                    padding: 10,
                    cornerRadius: 4,
                    callbacks: {
                        title: function(context) {
                            return 'Ngày ' + context[0].label + '/' + month;
                        },
                        label: function(context) {
                            const val = context.raw;
                            return 'Doanh thu: ' + val.toLocaleString('vi-VN') + '₫';
                        }
                    }
                }
            },
            animation: {
                duration: 600,
                easing: 'easeOutQuart'
            }
        }
    });
}

/**
 * Trả về số ngày của một tháng trong năm
 * @param {number} month 
 * @param {number} year 
 * @returns {number}
 */
function getDaysInMonth(month, year) {
    return new Date(year, month, 0).getDate();
}
 