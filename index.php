<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulario de Contacto</title>
  
  <link rel="stylesheet" href="css/styles.css">
  
  <link rel="icon" type="image/png" sizes="32x32" href="./assets/images/favicon-32x32.png">
</head>
<body>

  <main>
    <div class="contact-form-card">
      
      <h1>Contáctanos</h1>

      <form action="php/procesar.php" method="POST" novalidate>

        <div class="form-row">
          
          <div class="form-group">
            <label for="nombre">Nombre <span class="asterisk">*</span></label>
            <input type="text" id="nombre" name="nombre" required aria-required="true">
            <span class="error-text" id="error-nombre">Este campo es obligatorio</span>
          </div>

          <div class="form-group">
            <label for="apellido">Apellido <span class="asterisk">*</span></label>
            <input type="text" id="apellido" name="apellido" required aria-required="true">
            <span class="error-text" id="error-apellido">Este campo es obligatorio</span>
          </div>

        </div>

        <div class="form-group">
          <label for="email">Dirección de correo electrónico <span class="asterisk">*</span></label>
          <input type="email" id="email" name="email" required aria-required="true">
          <span class="error-text" id="error-email">Por favor, introduce una dirección de correo válida</span>
        </div>

        <div class="form-group">
          <fieldset>
            <legend>Tipo de consulta <span class="asterisk">*</span></legend>
            
            <div class="radio-group">
              <div class="radio-option">
                <input type="radio" id="general" name="tipo_consulta" value="consulta_general" required>
                <label for="general">Consulta general</label>
              </div>

              <div class="radio-option">
                <input type="radio" id="soporte" name="tipo_consulta" value="solicitud_soporte">
                <label for="soporte">Solicitud de soporte</label>
              </div>
            </div>
            
            <span class="error-text" id="error-tipo-consulta">Por favor, selecciona un tipo de consulta</span>
          </fieldset>
        </div>

        <div class="form-group">
          <label for="mensaje">Mensaje <span class="asterisk">*</span></label>
          <textarea id="mensaje" name="mensaje" rows="4" required aria-required="true"></textarea>
          <span class="error-text" id="error-mensaje">Este campo es obligatorio</span>
        </div>

        <div class="form-group checkbox-container">
          <div class="checkbox-wrapper">
            <input type="checkbox" id="consentimiento" name="consentimiento" required aria-required="true">
            <label for="consentimiento">Acepto ser contactado por el equipo <span class="asterisk">*</span></label>
          </div>
          <span class="error-text" id="error-consentimiento">Para enviar este formulario, por favor consiente ser contactado</span>
        </div>

        <button type="submit" class="submit-btn">Enviar</button>

      </form>
    </div>
  </main>
  
  <div class="autor">
    Formulario de contacto &copy; 2026. 
    Desarrollado por <a href="#">Fabian Kinil Adame</a>.
  </div>

  <div id="success-message" class="toast <?php echo isset($_GET['success']) ? '' : 'hidden'; ?>" role="alert" aria-live="polite">
    <div class="toast-header">
      <img src="assets/images/icon-success-check.svg" alt="Éxito">
      <span>¡Mensaje Enviado!</span>
    </div>
    <p>Gracias por completar el formulario. ¡Nos pondremos en contacto pronto!</p>
  </div>

  <!-- Script de validación JavaScript -->
  <script src="js/validation.js"></script>

</body>
</html>