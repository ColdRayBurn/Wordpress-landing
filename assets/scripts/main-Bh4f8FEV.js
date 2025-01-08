(function polyfill() {
  const relList = document.createElement("link").relList;
  if (relList && relList.supports && relList.supports("modulepreload")) {
    return;
  }
  for (const link of document.querySelectorAll('link[rel="modulepreload"]')) {
    processPreload(link);
  }
  new MutationObserver((mutations) => {
    for (const mutation of mutations) {
      if (mutation.type !== "childList") {
        continue;
      }
      for (const node of mutation.addedNodes) {
        if (node.tagName === "LINK" && node.rel === "modulepreload")
          processPreload(node);
      }
    }
  }).observe(document, { childList: true, subtree: true });
  function getFetchOpts(link) {
    const fetchOpts = {};
    if (link.integrity) fetchOpts.integrity = link.integrity;
    if (link.referrerPolicy) fetchOpts.referrerPolicy = link.referrerPolicy;
    if (link.crossOrigin === "use-credentials")
      fetchOpts.credentials = "include";
    else if (link.crossOrigin === "anonymous") fetchOpts.credentials = "omit";
    else fetchOpts.credentials = "same-origin";
    return fetchOpts;
  }
  function processPreload(link) {
    if (link.ep)
      return;
    link.ep = true;
    const fetchOpts = getFetchOpts(link);
    fetch(link.href, fetchOpts);
  }
})();
document.addEventListener("DOMContentLoaded", function() {
  var phoneInputs = document.querySelectorAll("input[data-tel-input]");
  var getInputNumbersValue = function(input) {
    return input.value.replace(/\D/g, "");
  };
  var onPhonePaste = function(e) {
    var input = e.target, inputNumbersValue = getInputNumbersValue(input);
    var pasted = e.clipboardData || window.clipboardData;
    if (pasted) {
      var pastedText = pasted.getData("Text");
      if (/\D/g.test(pastedText)) {
        input.value = inputNumbersValue;
        return;
      }
    }
  };
  var onPhoneInput = function(e) {
    var input = e.target, inputNumbersValue = getInputNumbersValue(input), selectionStart = input.selectionStart, formattedInputValue = "";
    if (!inputNumbersValue) {
      return input.value = "";
    }
    if (input.value.length != selectionStart) {
      if (e.data && /\D/g.test(e.data)) {
        input.value = inputNumbersValue;
      }
      return;
    }
    if (["7", "8", "9"].indexOf(inputNumbersValue[0]) > -1) {
      if (inputNumbersValue[0] == "9") inputNumbersValue = "7" + inputNumbersValue;
      var firstSymbols = inputNumbersValue[0] == "8" ? "8" : "+7";
      formattedInputValue = input.value = firstSymbols + " ";
      if (inputNumbersValue.length > 1) {
        formattedInputValue += "(" + inputNumbersValue.substring(1, 4);
      }
      if (inputNumbersValue.length >= 5) {
        formattedInputValue += ") " + inputNumbersValue.substring(4, 7);
      }
      if (inputNumbersValue.length >= 8) {
        formattedInputValue += "-" + inputNumbersValue.substring(7, 9);
      }
      if (inputNumbersValue.length >= 10) {
        formattedInputValue += "-" + inputNumbersValue.substring(9, 11);
      }
    } else {
      formattedInputValue = "+" + inputNumbersValue.substring(0, 16);
    }
    input.value = formattedInputValue;
  };
  var onPhoneKeyDown = function(e) {
    var inputValue = e.target.value.replace(/\D/g, "");
    if (e.keyCode == 8 && inputValue.length == 1) {
      e.target.value = "";
    }
  };
  for (var phoneInput of phoneInputs) {
    phoneInput.addEventListener("keydown", onPhoneKeyDown);
    phoneInput.addEventListener("input", onPhoneInput, false);
    phoneInput.addEventListener("paste", onPhonePaste, false);
  }
});
const showModal = (modal) => {
  const element = modal instanceof HTMLElement ? modal : document.querySelector(modal);
  element.classList.toggle("modal_visible", true);
  element.querySelector(".modal__body").animate(
    [
      {
        opacity: 0,
        scale: 0
      },
      {
        opacity: 1,
        scale: 1
      }
    ],
    { easing: "ease", duration: 500 }
  );
  document.body.style.overflow = "hidden";
};
const hideModal = (modal) => {
  const element = modal instanceof HTMLElement ? modal : document.querySelector(modal);
  const animation = modal.animate(
    [
      {
        opacity: 1,
        scale: 1
      },
      {
        opacity: 0,
        scale: 0
      }
    ],
    { easing: "ease", duration: 500 }
  );
  animation.addEventListener(
    "finish",
    () => {
      element.classList.toggle("modal_visible", false);
    },
    { once: false }
  );
  document.body.style.overflow = "";
};
document.querySelectorAll(".modal").forEach((modal) => {
  modal.querySelector(".modal__backdrop").addEventListener("click", () => hideModal(modal));
  modal.querySelector(".modal__close-button").addEventListener("click", () => hideModal(modal));
});
document.querySelectorAll("[data-modal]:not(.modal)").forEach((modalButton) => {
  const modal = document.querySelector(`.modal[data-modal="${modalButton.dataset.modal}"]`);
  if (modal === null) {
    return;
  }
  modalButton.addEventListener("click", () => {
    showModal(modal);
  });
});
document.querySelectorAll(".header-hamburger-menu__item").forEach((element) => {
  element.addEventListener("click", () => {
    document.querySelector(".header-hamburger-menu").classList.toggle("header-hamburger-menu_expanded", false);
  });
});
document.querySelector(".header__hamburger-button").addEventListener("click", () => {
  document.querySelector(".header-hamburger-menu").classList.toggle("header-hamburger-menu_expanded");
});
export {
  showModal as s
};
