const showQr = document.getElementById("show-qr");

showQr.addEventListener("click", () => {
  console.log("ciao");
  const qrcode = document.getElementById("qrcode");
  qrcode.classList.toggle("opacity-0");
});
