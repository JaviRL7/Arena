document.addEventListener('DOMContentLoaded', function() {
    const csrfToken = document.querySelector('meta[name="csrf-token"]').content;
    const predictionsStoreUrl = document.querySelector('meta[name="predictions-store-url"]').content;
    const voteMessage = document.getElementById('voteMessage'); // Asegúrate de que este ID esté en el span del mensaje

    document.querySelectorAll('.vote-button').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const form = button.closest('form');
            const formData = new FormData(form);
            formData.set(button.name, button.value); // Set the correct value for team_1_win

            fetch(predictionsStoreUrl, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-CSRF-TOKEN': csrfToken, // Use the CSRF token obtained earlier
                    'Accept': 'application/json', // Expect a JSON response
                },
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                console.log(data); // Muestra la respuesta en la consola
                // Update the progress bars based on the response
                const progressBarTeam1 = document.querySelector('.progress-bar.bg-primary');
                const progressBarTeam2 = document.querySelector('.progress-bar.bg-danger');
                const percentageTextTeam1 = progressBarTeam1.querySelector('.titular');
                const percentageTextTeam2 = progressBarTeam2.querySelector('.titular');

                if (progressBarTeam1 && progressBarTeam2) {
                    progressBarTeam1.style.width = `${data.percentageTeam1}%`;
                    progressBarTeam1.setAttribute('aria-valuenow', data.percentageTeam1);
                    progressBarTeam2.style.width = `${100 - data.percentageTeam1}%`;
                    progressBarTeam2.setAttribute('aria-valuenow', 100 - data.percentageTeam1);

                    if (percentageTextTeam1 && percentageTextTeam2) {
                        percentageTextTeam1.textContent = `${data.percentageTeam1.toFixed(0)}%`; // Actualiza el texto del porcentaje
                        percentageTextTeam2.textContent = `${(100 - data.percentageTeam1).toFixed(0)}%`; // Actualiza el texto del porcentaje
                    }
                } else {
                    console.error('Progress bars not found');
                }
                if (voteMessage) {
                    const votedTeamName = button.getAttribute('data-team-name'); // Obtener el nombre del equipo del atributo de datos
                    voteMessage.innerHTML = `You have already voted for #${votedTeamName}_win. Do you want to change your vote?`;
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });
});
