const validationMessages = {
    required: ' შევსება სავალდებულოა.',
    email: ' გამოიყენე ემაილის ფორმატი.',
    minLength: (min) => ` უნდა შეიცავდეს მინიმუმ ${min} სიმბოლოს.`,
    maxLength: (max) => ` არ უნდა აღემატებოდეს ${max} სიმბოლოს.`,
    numeric: ' უნდა შეიცავდეს მხოლოდ რიცხვებს.',
    // Add more validators as needed
};

export const errorMessage = (validator, param = null) => {
    // Handle validators that require parameters (e.g., minLength)
    if (typeof validationMessages[validator] === "function") {
        return validationMessages[
            validator
        ](param);
    }
    return validationMessages[validator];
};
