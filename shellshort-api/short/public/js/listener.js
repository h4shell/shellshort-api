const input = document.querySelector("input");
const shortLink = document.querySelector("#short_link");
const latBar = document.querySelector("#latbar");
function showLat() {
  latBar.classList.toggle("w-[300px]");
}

function makeUrl() {
  const input64 = btoa(input.value);
  fetch(`/api/${input64}`)
    .then((response) => response.json())
    .then((text) => {
      if (text.error) {
        const boxError = document.querySelector("#box-error");
        boxError.classList.remove("hide");
        input.value = "";
      } else {
        const urlShort = `${window.location.origin}/statistic/${text.code}`;
        window.location.href = urlShort;
      }
    });
}

input.addEventListener("keydown", function (event) {
  if (event.key === "Enter") {
    makeUrl();
  }
});

function toggleAnswer(answerId) {
  const answer = document.getElementById(answerId);
  answer.classList.toggle("hidden");
}
