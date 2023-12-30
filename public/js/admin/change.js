
document.getElementById('toggleView').addEventListener('click', function() {
    var gamesTable = document.getElementById('gamesTable');
    var seriesTable = document.getElementById('seriesTable');

    if (gamesTable.style.display === 'none') {
        gamesTable.style.display = 'block';
        seriesTable.style.display = 'none';
        localStorage.setItem('view', 'games');
    } else {
        gamesTable.style.display = 'none';
        seriesTable.style.display = 'block';
        localStorage.setItem('view', 'series');
    }
});

window.onload = function() {
    var view = localStorage.getItem('view');
    var gamesTable = document.getElementById('gamesTable');
    var seriesTable = document.getElementById('seriesTable');

    if (view === 'games') {
        gamesTable.style.display = 'block';
        seriesTable.style.display = 'none';
    } else if (view === 'series') {
        gamesTable.style.display = 'none';
        seriesTable.style.display = 'block';
    }
};
