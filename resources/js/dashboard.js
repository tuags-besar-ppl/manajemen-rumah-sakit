// Small Sparkline Charts for KPIs
const createSparkline = (ctx, color, fill = false) => {
    const data = {
        labels: Array.from({length: 12}, (_, i) => i),
        datasets: [{
            data: Array.from({length: 12}, () => Math.floor(Math.random() * 100)),
            borderColor: color,
            borderWidth: 2,
            backgroundColor: fill ? color + '20' : 'transparent',
            fill: fill,
            tension: 0.4,
            pointRadius: 0
        }]
    };
    
    return new Chart(ctx, {
        type: 'line',
        data: data,
        options: {
            responsive: true,
            plugins: {
                legend: {
                    display: false,
                },
                tooltip: {
                    enabled: false
                }
            },
            scales: {
                x: {
                    display: false,
                },
                y: {
                    display: false,
                }
            },
            maintainAspectRatio: false
        }
    });
};

// Create sparkline charts when DOM is loaded
document.addEventListener('DOMContentLoaded', function() {
    // Create sparkline charts
    createSparkline(document.getElementById('revenueChart').getContext('2d'), '#10b981', true);
    createSparkline(document.getElementById('customersChart').getContext('2d'), '#ef4444', true);
    createSparkline(document.getElementById('ordersChart').getContext('2d'), '#10b981', true);
    
    // Monthly Orders Chart
    const monthlyOrdersCtx = document.getElementById('monthlyOrdersChart').getContext('2d');
    const monthlyOrdersChart = new Chart(monthlyOrdersCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Orders',
                data: [2500, 3200, 4500, 3000, 5600, 5800, 6800, 7500, 8900, 7400, 9200, 8900],
                backgroundColor: 'rgba(255, 193, 7, 0.2)',
                borderColor: 'rgba(255, 193, 7, 1)',
                borderWidth: 2,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value.toLocaleString();
                        }
                    }
                }
            }
        }
    });
    
    // Total Customers Chart
    const totalCustomersCtx = document.getElementById('totalCustomersChart').getContext('2d');
    const totalCustomersChart = new Chart(totalCustomersCtx, {
        type: 'line',
        data: {
            labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
            datasets: [{
                label: 'Customers',
                data: [4500, 5800, 6700, 7900, 8500, 9200, 10100, 10800, 13200, 14100, 16500, 17800],
                backgroundColor: 'rgba(13, 110, 253, 0.2)',
                borderColor: 'rgba(13, 110, 253, 1)',
                borderWidth: 2,
                fill: true,
                tension: 0.4
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    position: 'bottom',
                }
            },
            scales: {
                y: {
                    beginAtZero: true,
                    ticks: {
                        callback: function(value) {
                            return value.toLocaleString();
                        }
                    }
                }
            }
        }
    });
});