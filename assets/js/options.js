const pagoMovilInfo = document.getElementById("pago_movil_info");
const transferenciaBancariaInfo = document.getElementById("transferencia_bancaria_info");

const pagoMovilRadioButton = document.getElementById("pagoMovil");
const transferenciaBancariaRadioButton = document.getElementById("transferencia");

pagoMovilRadioButton.addEventListener("click", () => {
  pagoMovilInfo.style.display = "block";
  transferenciaBancariaInfo.style.display = "none";
});

transferenciaBancariaRadioButton.addEventListener("click", () => {
  pagoMovilInfo.style.display = "none";
  transferenciaBancariaInfo.style.display = "block";
});
