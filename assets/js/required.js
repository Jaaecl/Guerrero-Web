var pagoMovilInput = document.getElementById('pagoMovil_imagen');
var transferenciaInput = document.getElementById('transferencia_imagen');

document.getElementById('pagoMovil').addEventListener('click', function() {
  pagoMovilInput.setAttribute('required', true);
  transferenciaInput.removeAttribute('required');
});

document.getElementById('transferencia').addEventListener('click', function() {
  transferenciaInput.setAttribute('required', true);
  pagoMovilInput.removeAttribute('required');
});