document.addEventListener('DOMContentLoaded', function() {
    // Selecciona todos los textareas de revisión
    var reviewTextareas = document.querySelectorAll('.review-textarea');

    reviewTextareas.forEach(function(reviewTextarea) {
        // Añade event listener para el evento 'input'
        reviewTextarea.addEventListener('input', function() {
            // Obtén el form ID
            var formId = this.dataset.formId;
            // Selecciona los mensajes de error específicos para este formulario
            var lengthErrorMessage = document.querySelector('.length-error-message[data-form-id="' + formId + '"]');
            var htmlErrorMessage = document.querySelector('.html-error-message[data-form-id="' + formId + '"]');

            // Comprueba la longitud de la revisión
            if (this.value.length > 150) {
                // Muestra el mensaje de error de longitud
                lengthErrorMessage.style.display = 'block';
            } else {
                // Oculta el mensaje de error de longitud
                lengthErrorMessage.style.display = 'none';
            }

            // Comprueba si la revisión contiene etiquetas HTML
            if (/<(.|\n)*?>/.test(this.value)) {
                // Muestra el mensaje de error de HTML
                htmlErrorMessage.style.display = 'block';
            } else {
                // Oculta el mensaje de error de HTML
                htmlErrorMessage.style.display = 'none';
            }
        });
    });

    // Selecciona todos los formularios de revisión
    var reviewForms = document.querySelectorAll('.review-form');

    reviewForms.forEach(function(form) {
        // Añade event listener para el evento 'submit'
        form.addEventListener('submit', function(event) {
            // Obtén el form ID
            var formId = form.getAttribute('data-form-id');
            // Selecciona los elementos de revisión y mensajes de error específicos para este formulario
            var reviewTextarea = document.querySelector('.review-textarea[data-form-id="' + formId + '"]');
            var lengthErrorMessage = document.querySelector('.length-error-message[data-form-id="' + formId + '"]');
            var htmlErrorMessage = document.querySelector('.html-error-message[data-form-id="' + formId + '"]');

            // Comprueba si alguno de los mensajes de error está visible
            if (lengthErrorMessage.style.display === 'block' || htmlErrorMessage.style.display === 'block') {
                // Si hay errores, evita que el formulario se envíe
                event.preventDefault();
            }
        });
    });
});
