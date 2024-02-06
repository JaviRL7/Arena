<!-- Cookie Modal -->
<div class="modal fade" id="cookieModal" tabindex="-1" aria-labelledby="cookieModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg modal-footer">
        <div class="modal-content">
            <div class="modal-body text-center">
                <i class="fas fa-cookie-bite fa-4x mb-3"></i>
                <p class="comentarios" class="lead">We use cookies to improve your experience. By continuing to browse, you agree to our <a href="https://www.interior.gob.es/opencms/documentacion/Guia_de_Cookies.pdf" target="_blank" rel="noopener noreferrer">terms of use</a>.</p>
                <button type="button" class="btn btn-boton6" data-dismiss="modal">Accept Cookies</button>
            </div>
        </div>
    </div>
</div>

<!-- Terms Modal -->
<div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="termsModalLabel">Terms of Use</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- PDF content or terms content here -->
                <object data="https://www.interior.gob.es/opencms/documentacion/Guia_de_Cookies.pdf" type="application/pdf" width="100%" height="100%">
                    <p class="comentarios">It appears you don't have a PDF plugin for this browser. No problem... you can <a href="https://www.interior.gob.es/opencms/documentacion/Guia_de_Cookies.pdf" target="_blank">click here to download the PDF file.</a></p>
                </object>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-boton8" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener("DOMContentLoaded", function() {
    window.onload = function() {
        var cookieNotice = $('#cookieModal');
        if (!getCookie('gunlim')) {
            cookieNotice.modal('show');
        }

        cookieNotice.find('.btn-boton6').click(function() { // Cambia 'btn-primary' a 'btn-boton6'
            var date = new Date();
            date.setFullYear(date.getFullYear() + 1);
            document.cookie = 'gunlim=true; expires=' + date.toUTCString() + '; path=/';
            $('#cookieModal').modal('hide');
        });

        function getCookie(name) {
            var value = '; ' + document.cookie;
            var parts = value.split('; ' + name + '=');
            if (parts.length == 2) return parts.pop().split(';').shift();
        }
    };
});
</script>
