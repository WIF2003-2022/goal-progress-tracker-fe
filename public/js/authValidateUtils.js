export const showError = (fieldId) => {
  const field = document.getElementById(fieldId);
  const errMsg = document.getElementById(`${fieldId}-feedback`);
  if (field.validity.valueMissing) {
    errMsg.textContent = "This field should not be empty.";
  } else if (field.validity.typeMismatch) {
    errMsg.textContent = `Invalid input. Please enter a valid ${field.type}`;
  } else if (field.validity.patternMismatch) {
    errMsg.textContent = `Please make sure your input follows the format, i.e. ${
      field.dataset?.patternDesc ?? ""
    }.`;
  } else if (field.validity.tooLong) {
    errMsg.textContent = `Enter at least ${field.minLength} characters.`;
  }

  errMsg.classList = "invalid-feedback";
};

export const resetError = (fieldId) => {
  const errMsg = document.getElementById(`${fieldId}-feedback`);
  errMsg.textContent = "";
  errMsg.classList = "valid-feedback";
};
