$(document).ready(function() {
    console.log("Documento listo");
    $(".owl-carousel").owlCarousel({
        items: 1,
        loop: true,
        margin: 10,
        //autoplay: true,
        autoplayTimeout: 3000,
        autoplayHoverPause: true
    });
});


$('.year-button').click(function() {
    var year = $(this).data('year');
    $('.players').hide();
    $('#players-' + year).show();
});

let championData = window.championData;

for (let championId in championData) {
    let ctx = document.getElementById('chart-' + championId).getContext('2d');
    let winPercentage = championData[championId].stats.win_percentage;
    let lossPercentage = championData[championId].stats.loss_percentage;

    let chart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Victorias', 'Derrotas'],
            datasets: [{
                data: [winPercentage, lossPercentage],
                backgroundColor: ['blue', 'red'],
            }]
        },
        options: {
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}
