const validationRegex = {
  email: {
    pattern:
      /(?:[a-z0-9!#$%&'*+\/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+\/=?^_`{|}~-]+)*|"(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?|\[(?:(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9]))\.){3}(?:(2(5[0-5]|[0-4][0-9])|1[0-9][0-9]|[1-9]?[0-9])|[a-z0-9-]*[a-z0-9]:(?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/,
    errorMsg:
      "Incorrect format. Email should be in the format goaltracker@gmail.com",
  },
  password: {
    pattern:
      /(?=^.{8,}$)(?=.*\d)(?=.*[!@#$%^&*]+)(?![.\n])(?=.*[A-Z])(?=.*[a-z]).*$/,
    errorMsg:
      "Incorrect format. Password should have at least 8 characters, including at least 1 uppercase letter, 1 symbol and 1 numeric character.",
  },
  username: {
    pattern: /^\S+$/,
    errorMsg: "Username should not contain space.",
  },
};

const validateFormAndGetErrorMessages = (formData) => {
  const error = {};
  for (var property in formData) {
    if (!validationRegex.hasOwnProperty(property)) {
      continue;
    }
    const { pattern, errorMsg } = validationRegex[property];
    if (pattern?.test(formData[property])) {
      error[property] = errorMsg;
    }
  }

  return error;
};
