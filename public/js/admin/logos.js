$(document).ready(function() {
    function formatTeam (team) {
        if (!team.id) {
            return team.text;
        }
        var $team = $(
            '<span class="team-option">' + team.text + ' <img src="' + team.element.dataset.logo + '" class="img-flag" /></span>'
        );
        return $team;
    };

    $("#team_1_id, #team_2_id, #competition").select2({
        templateResult: formatTeam
    });
});
