// ============================================
// VALIDACIÓN DEL FORMULARIO DE CONTACTO
// Con soporte completo de accesibilidad ARIA
// ============================================

document.addEventListener('DOMContentLoaded', function() {
  
  const form = document.querySelector('form');
  const nombreInput = document.getElementById('nombre');
  const apellidoInput = document.getElementById('apellido');
  const emailInput = document.getElementById('email');
  const mensajeTextarea = document.getElementById('mensaje');
  const consentimientoCheckbox = document.getElementById('consentimiento');
  const tipoConsultaRadios = document.querySelectorAll('input[name="tipo_consulta"]');
  const successToast = document.getElementById('success-message');

  // ============================================
  // FUNCIONES DE VALIDACIÓN
  // ============================================

  /**
   * Valida si un campo está vacío
   */
  function validarCampoVacio(input) {
    return input.value.trim() === '';
  }

  /**
   * Valida formato de email
   */
  function validarEmail(email) {
    const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    return regex.test(email);
  }

  /**
   * Valida si al menos un radio está seleccionado
   */
  function validarRadio(radios) {
    return Array.from(radios).some(radio => radio.checked);
  }

  // ============================================
  // MOSTRAR/OCULTAR ERRORES
  // ============================================

  /**
   * Muestra el mensaje de error y actualiza atributos ARIA
   */
  function mostrarError(input, errorElement) {
    input.classList.add('input-error');
    errorElement.classList.add('error-visible');
    input.setAttribute('aria-invalid', 'true');
    input.setAttribute('aria-describedby', errorElement.id || '');
  }

  /**
   * Oculta el mensaje de error y actualiza atributos ARIA
   */
  function ocultarError(input, errorElement) {
    input.classList.remove('input-error');
    errorElement.classList.remove('error-visible');
    input.setAttribute('aria-invalid', 'false');
    input.removeAttribute('aria-describedby');
  }

  // ============================================
  // VALIDACIÓN DE CADA CAMPO
  // ============================================

  /**
   * Valida el campo nombre
   */
  function validarNombre() {
    const errorElement = nombreInput.parentElement.querySelector('.error-text');
    
    if (validarCampoVacio(nombreInput)) {
      mostrarError(nombreInput, errorElement);
      return false;
    } else {
      ocultarError(nombreInput, errorElement);
      return true;
    }
  }

  /**
   * Valida el campo apellido
   */
  function validarApellido() {
    const errorElement = apellidoInput.parentElement.querySelector('.error-text');
    
    if (validarCampoVacio(apellidoInput)) {
      mostrarError(apellidoInput, errorElement);
      return false;
    } else {
      ocultarError(apellidoInput, errorElement);
      return true;
    }
  }

  /**
   * Valida el campo email
   */
  function validarEmailCampo() {
    const errorElement = emailInput.parentElement.querySelector('.error-text');
    
    if (validarCampoVacio(emailInput)) {
      errorElement.textContent = 'Este campo es obligatorio';
      mostrarError(emailInput, errorElement);
      return false;
    } else if (!validarEmail(emailInput.value)) {
      errorElement.textContent = 'Por favor, introduce una dirección de correo válida';
      mostrarError(emailInput, errorElement);
      return false;
    } else {
      ocultarError(emailInput, errorElement);
      return true;
    }
  }

  /**
   * Valida el tipo de consulta (radio buttons)
   */
  function validarTipoConsulta() {
    const fieldset = document.querySelector('fieldset');
    const errorElement = fieldset.querySelector('.error-text');
    
    if (!validarRadio(tipoConsultaRadios)) {
      errorElement.classList.add('error-visible');
      fieldset.setAttribute('aria-invalid', 'true');
      return false;
    } else {
      errorElement.classList.remove('error-visible');
      fieldset.setAttribute('aria-invalid', 'false');
      return true;
    }
  }

  /**
   * Valida el campo mensaje
   */
  function validarMensaje() {
    const errorElement = mensajeTextarea.parentElement.querySelector('.error-text');
    
    if (validarCampoVacio(mensajeTextarea)) {
      mostrarError(mensajeTextarea, errorElement);
      return false;
    } else {
      ocultarError(mensajeTextarea, errorElement);
      return true;
    }
  }

  /**
   * Valida el checkbox de consentimiento
   */
  function validarConsentimiento() {
    const checkboxContainer = consentimientoCheckbox.closest('.form-group');
    const errorElement = checkboxContainer.querySelector('.error-text');
    
    if (!consentimientoCheckbox.checked) {
      errorElement.classList.add('error-visible');
      consentimientoCheckbox.setAttribute('aria-invalid', 'true');
      return false;
    } else {
      errorElement.classList.remove('error-visible');
      consentimientoCheckbox.setAttribute('aria-invalid', 'false');
      return true;
    }
  }

  // ============================================
  // EVENTOS EN TIEMPO REAL (blur)
  // ============================================

  nombreInput.addEventListener('blur', validarNombre);
  apellidoInput.addEventListener('blur', validarApellido);
  emailInput.addEventListener('blur', validarEmailCampo);
  mensajeTextarea.addEventListener('blur', validarMensaje);
  consentimientoCheckbox.addEventListener('change', validarConsentimiento);
  
  tipoConsultaRadios.forEach(radio => {
    radio.addEventListener('change', validarTipoConsulta);
  });

  // ============================================
  // VALIDACIÓN AL ENVIAR EL FORMULARIO
  // ============================================

  form.addEventListener('submit', function(e) {
    e.preventDefault();

    // Validar todos los campos
    const nombreValido = validarNombre();
    const apellidoValido = validarApellido();
    const emailValido = validarEmailCampo();
    const tipoConsultaValido = validarTipoConsulta();
    const mensajeValido = validarMensaje();
    const consentimientoValido = validarConsentimiento();

    // Si todos son válidos, enviar el formulario
    if (nombreValido && apellidoValido && emailValido && tipoConsultaValido && mensajeValido && consentimientoValido) {
      form.submit();
    } else {
      // Enfocar el primer campo con error
      const primerError = document.querySelector('.input-error, [aria-invalid="true"]');
      if (primerError) {
        primerError.focus();
      }
    }
  });

  // ============================================
  // ATRIBUTOS ARIA INICIALES
  // ============================================

  // Agregar IDs únicos a los mensajes de error para aria-describedby
  document.querySelectorAll('.error-text').forEach((error, index) => {
    if (!error.id) {
      error.id = `error-message-${index}`;
    }
  });

  // Configurar atributos ARIA en los inputs
  [nombreInput, apellidoInput, emailInput, mensajeTextarea].forEach(input => {
    input.setAttribute('aria-required', 'true');
    input.setAttribute('aria-invalid', 'false');
  });

  consentimientoCheckbox.setAttribute('aria-required', 'true');
  consentimientoCheckbox.setAttribute('aria-invalid', 'false');

  // ============================================
  // OCULTAR TOAST DE ÉXITO DESPUÉS DE 5 SEGUNDOS
  // ============================================

  if (successToast && !successToast.classList.contains('hidden')) {
    setTimeout(function() {
      successToast.classList.add('hidden');
    }, 5000);
  }

  // ============================================
  // ACCESIBILIDAD: Anunciar mensaje de éxito
  // ============================================

  if (successToast && !successToast.classList.contains('hidden')) {
    successToast.setAttribute('role', 'alert');
    successToast.setAttribute('aria-live', 'polite');
    successToast.setAttribute('aria-atomic', 'true');
  }

});