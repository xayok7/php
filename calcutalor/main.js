// main.js
let calculationDone = false;

function append(val) {
  const display = document.getElementById("display");
  if (calculationDone) {
    display.value = "";
    calculationDone = false;
  }
  display.value += val;
  updatePreview();
}

function appendTrig(func) {
  const display = document.getElementById("display");
  if (calculationDone) {
    display.value = "";
    calculationDone = false;
  }
  display.value += func + '(';
  updatePreview();
}

function clearDisplay() {
  const display = document.getElementById("display");
  const preview = document.getElementById("preview");
  display.value = "";
  preview.textContent = "";
  preview.classList.remove("error");
  calculationDone = false;
}

function backspace() {
  const display = document.getElementById("display");
  display.value = display.value.slice(0, -1);
  updatePreview();
}

function updatePreview() {
  const display = document.getElementById("display");
  const preview = document.getElementById("preview");
  preview.textContent = display.value;
}

function calculate() {
  const display = document.getElementById("display");
  const exprPost = document.getElementById("exprPost");
  exprPost.value = display.value;
  document.getElementById('calcForm').submit();
}

document.addEventListener("keydown", (event) => {
  const key = event.key;
  if (/[0-9]/.test(key) || ["+","-","*","/",".","(",")"].includes(key)) {
    append(key);
  } else if (key === "Enter") {
    event.preventDefault();
    calculate();
  } else if (key === "Backspace") {
    event.preventDefault();
    backspace();
  } else if (key === "Escape") {
    event.preventDefault();
    clearDisplay();
  }
});

window.onload = function() {
  const urlParams = new URLSearchParams(window.location.search);
  const result = urlParams.get('result');
  if (result) {
    const display = document.getElementById("display");
    const preview = document.getElementById("preview");
    display.value = result;
    preview.textContent = result;
    calculationDone = true;
  }
}
