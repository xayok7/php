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
  const expr = document.getElementById("display").value;
  const preview = document.getElementById("preview");
  if (!expr) {
    preview.textContent = "";
    return;
  }
  try {
    const result = evaluateExpression(expr);
    preview.textContent = "= " + result;
    preview.classList.remove("error");
  } catch (e) {
    preview.textContent = e.message;
    preview.classList.add("error");
  }
}

function evaluateExpression(expr) {
  if (expr.includes("/0")) {
    throw new Error("Деление на ноль!");
  }
  const sanitized = expr.replace(/[^0-9+\-*/().]/g, "");
  if (sanitized !== expr) throw new Error("Недопустимое выражение!");
  let result;
  try {
    result = Function('"use strict";return (' + expr + ")")();
  } catch {
    throw new Error("Ошибка вычисления!");
  }
  if (isNaN(result) || !isFinite(result)) throw new Error("Ошибка вычисления!");
  if (Math.abs(result) > 1e15) throw new Error("Слишком большое число!");
  return (typeof result === "number" && result % 1 !== 0)
    ? Number.parseFloat(result.toFixed(10))
    : result;
}

function calculate() {
  const expr = document.getElementById("display").value;
  if (!expr) return;
  document.getElementById("exprPost").value = expr;
  document.getElementById("calcForm").submit();
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

window.addEventListener("DOMContentLoaded", () => {
  const params = new URLSearchParams(window.location.search);
  if (params.has("result")) {
    const res = params.get("result");
    const display = document.getElementById("display");
    display.value = res;
    updatePreview();
    calculationDone = true;
    window.history.replaceState({}, document.title, window.location.pathname);
  } else {
    clearDisplay();
  }
});
