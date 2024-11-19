function showQr() {
  console.log("ciao");
  const qrcode = document.getElementById("qrcode");
  qrcode.classList.toggle("opacity-0");
}

function qr(link) {
  const qrcode = new QRCode(document.querySelector("#qrcode"), {
    text: link,
    width: 150,
    height: 150,
    colorDark: "#000000",
    colorLight: "#ffffff",
    correctLevel: QRCode.CorrectLevel.H,
  });
}
