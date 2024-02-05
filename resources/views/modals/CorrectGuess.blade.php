<!-- Correct Guess Modal -->
<div class="modal fade" id="correctGuessModal" tabindex="-1" aria-labelledby="correctGuessModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-center titulo2" id="correctGuessModalLabel">Congratulations!</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body d-flex align-items-center justify-content-center">
          <h3 class="titulo">You've guessed the player correctly!</h3>
          <img id="randomEmote" src="" alt="Emote" style="max-width: 140px; height: auto;">

        </div>
        <h4 class="titular text-center" id="pointsEarned"></h4>
        <div class="player-photo-container d-flex flex-column align-items-center">
            <img id="guessedPlayerPhoto" src="" alt="Player Photo" style="max-width: 100%; height: 200px; border-radius: 50%;">
            <h4 id="playerNick" class="text-center titulo3"></h4>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  <canvas id="my-canvas" style="position: fixed; top: 0; left: 0; pointer-events: none;"></canvas>

<script src="https://cdn.jsdelivr.net/npm/confetti-js@0.0.18/dist/index.min.js"></script>
<script>
  window.onload = function() {
    var randomNum = Math.floor(Math.random() * 10) + 1; // generates a random number between 1 and 10
    document.getElementById('randomEmote').src = '/emotes/h' + randomNum + '.png';
  }

  var confettiSettings = { target: 'my-canvas', max: '200' };
  var confetti = new ConfettiGenerator(confettiSettings);

  $('#correctGuessModal').on('shown.bs.modal', function () {
    confetti.render();
  })

  $('#correctGuessModal').on('hidden.bs.modal', function () {
    confetti.clear();
  })
</script>
