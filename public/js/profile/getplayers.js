$(document).ready(function() {
    $('#playersTable').DataTable({
        processing: true,
        serverSide: true,
        ajax: '/profile/getplayers',
        pageLength: 5,
        searching: false,
        lengthChange: false,
        columnDefs: [
            { width: '50%', targets: 0 },
            { width: '50%', targets: 1 }
        ],
        columns: [
            { data: 'photo', name: 'photo' },
            { data: 'nick', name: 'nick' }
        ]
    });
});

