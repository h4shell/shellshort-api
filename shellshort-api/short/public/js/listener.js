const input = document.querySelector("input");
const button = document.querySelector("button");
const shortLink = document.querySelector("#short_link");
const boxError = document.querySelector("#box-error");

button.addEventListener("click", () => {
  const input64 = btoa(input.value);
  fetch(`/api/${input64}`)
    .then((response) => response.json())
    .then((text) => {
      if (text.error) {
        boxError.classList.remove("hidden");
        input.value = "";
      } else {
        const urlShort = `${window.location.origin}/statistic/${text.code}`;
        window.location.href = urlShort;
      }
    });
});

input.addEventListener("keydown", function (event) {
  if (event.key === "Enter") {
    const input64 = btoa(input.value);
    fetch(`/api/${input64}`)
      .then((response) => response.json())
      .then((text) => {
        if (text.error) {
          boxError.classList.remove("hidden");
          input.value = "";
        } else {
          const urlShort = `${window.location.origin}/statistic/${text.code}`;
          window.location.href = urlShort;
        }
      });
  }
});

function toggleAnswer(answerId) {
  const answer = document.getElementById(answerId);
  answer.classList.toggle("hidden");
}
