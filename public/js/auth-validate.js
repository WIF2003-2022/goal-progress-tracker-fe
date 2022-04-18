// const email = document.getElementById("email");
// const username = document.getElementById("username");
// const password = document.getElementById("password");
const form = document.getElementById("register-form");
const inputFields = document.getElementsByTagName("input");

for (let input of inputFields) {
  input.addEventListener("input", (e) => {
    const field = document.getElementById(e.target.id);
    console.log(field, field.validity.valid);
    form.classList = "was-validated";
    if (field.validity.valid) {
      resetError(e.target.id);
    } else {
      showError(e.target.id);
      e.preventDefault();
    }
  });
}

form.addEventListener("submit", (e) => {
  const fields = document.getElementsByTagName("input");
  for (let field of fields) {
    if (!field.checkValidity()) {
      e.preventDefault();
      break;
    }
  }
});

const showError = (fieldId) => {
  const field = document.getElementById(fieldId);
  const errMsg = document.getElementById(`${fieldId}-feedback`);
  if (field.valueMissing) {
    errMsg.textContent = "This field should not be empty.";
  } else if (field.validity.typeMismatch) {
    errMsg.textContent = `Invalid input. Please enter a valid ${field.type}`;
  } else if (field.validity.patternMismatch) {
    errMsg.textContent = `Please make sure your input follows the format ${
      field.dataset?.format ?? ""
    }.`;
  } else if (field.validity.tooLong) {
    errMsg.textContent = `Enter at least ${field.minLength} characters.`;
  }

  errMsg.classList = "invalid-feedback";
};

const resetError = (fieldId) => {
  const errMsg = document.getElementById(`${fieldId}-feedback`);
  errMsg.textContent = "";
  errMsg.classList = "valid-feedback";
};
