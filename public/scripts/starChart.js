document.addEventListener('DOMContentLoaded', function () {
    const ctx = document.getElementById('starChart').getContext('2d');
    const data = {
        labels: ['0', '1', '2', '3', '4', '5', '6', '7', '8', '9', '10'],
        datasets: [{
            label: 'Number of Reviews for Each Star Rating',
            data: starCount,
            backgroundColor: '#f0a500',
            borderColor: '#3f9272',
            borderWidth: 1,
            textColor: 'white'
        }]
    };

    const config = {
        type: 'bar',
        data: data,
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                y: {
                    ticks: {
                        color: 'white',
                        beginAtZero: true,
                        stepSize: 1
                    },
                    grid: {
                        color: '#444'
                    }
                },
                x: {
                    ticks: {
                        color: 'white',
                        stepSize: 1
                    },
                    grid: {
                        color: '#444'
                    }
                }
            },
            layout: {
                padding: 5
            },
            backgroundColor: '#333'
        }
    };

    const starChart = new Chart(ctx, config);
});