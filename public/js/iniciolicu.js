$(document).ready(function () {
    console.log("📌 Iniciando validación de avisos...");

    // Función principal para verificar y mostrar modales
    function verificarAvisos() {
        console.log("🔍 Verificando estado de avisos...");

        // Primero verificar privacidad en la base de datos
        $.get(PRIVACIDAD_ESTADO_URL, function (response) {
            console.log("Respuesta BD - Privacidad:", response);
            
            const pdfVisto = localStorage.getItem('pdfVisto');
            console.log("PDF visto en localStorage:", pdfVisto);

            if (!response.aceptado) {
                // MOSTRAR PRIVACIDAD PRIMERO
                console.log("Mostrando aviso de privacidad (no aceptado en BD)");
                $('#modalPrivacidad').modal('show');
            } else if (!pdfVisto) {
                // Si ya aceptó privacidad pero no ha visto PDF
                console.log("Mostrando PDF (privacidad ya aceptada)");
                $('#autoopen').modal('show');
            } else {
                console.log("Ambos avisos han sido aceptados/vistos");
                // No mostrar ningún modal, continuar normal
            }
        }).fail(function (error) {
            console.error("Error al verificar privacidad:", error);
            // En caso de error, mostrar privacidad por seguridad
            $('#modalPrivacidad').modal('show');
        });
    }

    // Ejecutar verificación al cargar la página
    verificarAvisos();

    // Habilitar/deshabilitar botón de aceptar privacidad
    $('#chkPriv').on('change', function () {
        const isChecked = $(this).is(':checked');
        $('#btnAceptarPriv').prop('disabled', !isChecked);
        console.log("✓ Checkbox privacidad:", isChecked);
    });

    // Botón Aceptar Privacidad
    $('#btnAceptarPriv').on('click', function () {
        const $btn = $(this);
        const originalText = $btn.html();
        
        // Deshabilitar botón para evitar múltiples clics
        $btn.prop('disabled', true).html('<i class="fas fa-spinner fa-spin"></i> Guardando...');

        console.log("💾 Guardando aceptación de privacidad...");

        $.post(PRIVACIDAD_ACEPTAR_URL, {
            _token: CSRF_TOKEN
        }, function (response) {
            console.log("✅ Aviso de privacidad guardado:", response);
            
            // Guardar en localStorage
            localStorage.setItem('privacidadAceptada', '1');
            
            // Ocultar modal de privacidad
            $('#modalPrivacidad').modal('hide');
            
            // Restaurar botón
            $btn.html(originalText);
            
            // Verificar si necesita ver el PDF
            const pdfVisto = localStorage.getItem('pdfVisto');
            if (!pdfVisto) {
                console.log("📄 Mostrando PDF después de aceptar privacidad");
                setTimeout(() => {
                    $('#autoopen').modal('show');
                }, 500);
            }
            
        }).fail(function (error) {
            console.error("❌ Error al guardar privacidad:", error);
            alert('Error al guardar la aceptación. Por favor, intenta nuevamente.');
            $btn.prop('disabled', false).html(originalText);
        });
    });

    // Botón Aceptar Reglamento (PDF)
    $('#btnCerrarPdf').on('click', function () {
        console.log("📄 Reglamento aceptado, guardando en localStorage...");
        localStorage.setItem('pdfVisto', '1');
        $('#autoopen').modal('hide');
        
        console.log("🎉 Todos los avisos han sido aceptados");
    });

});