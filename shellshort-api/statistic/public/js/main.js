const shortLink = document.querySelector("#short_link");
const numberVisit = document.querySelector("#number_visit");
const longUrl = document.querySelector("#long_url");
const url = new URL(window.location.href);
const copyButton = document.querySelector("#copy-button");

// Ottieni i parametri della query string

// Stampa il valore del parametro 'c'
const cValue = url.pathname.split("/").pop();

shortLink.href = `${window.location.origin}/${cValue}`;
shortLink.innerText = `${window.location.origin}/${cValue}`;

function copyLink() {
  navigator.clipboard.writeText(shortLink.innerText);
  copyButton.classList.add("animate-pulse");
  copyButton.classList.add("bg-green-500");
}

fetch(`/api/statistic/${cValue}`)
  .then((response) => {
    const contentType = response.headers.get("Content-Type");
    if (contentType && contentType.includes("application/json")) {
      return response.json();
    } else {
      // Altrimenti, gestisci il caso in cui non sia JSON
      location.href = "/short/?error=not-json";
    }
  })
  .then((text) => {
    numberVisit.innerText = text.code.statistic;
    longUrl.innerText = text.code.url;
    qr(`${window.location.origin}/${cValue}`);
  });

shortLink.addEventListener("click", () => {
  copyLink();
});

copyButton.addEventListener("click", () => {
  copyLink();
});
