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
