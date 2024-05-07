// JavaScript to show/hide the popup
document.addEventListener("DOMContentLoaded", function () {
    // Get the popup container
    var popupContainer = document.getElementById('popupContainer');

    // Get the agree checkbox
    var agreeCheckbox = document.getElementById('agreeCheckbox');

    // Get the agree button
    var agreeButton = document.getElementById('agreeButton');

    // Disable the agree button initially
    agreeButton.disabled = true;

    // Show the popup
    popupContainer.style.display = 'block';

    // Function to check if the checkbox is clicked and enable/disable the button accordingly
    function checkAgreement() {
        if (agreeCheckbox.checked) {
            agreeButton.disabled = false;
        } else {
            agreeButton.disabled = true;
        }
    }

    // Add event listener to the agree checkbox to check for changes
    agreeCheckbox.addEventListener('change', checkAgreement);

    // Hide the popup when the Agree button is clicked only if the checkbox is checked
    agreeButton.addEventListener('click', function (event) {
        // Prevent form submission
        event.preventDefault();

        // Hide the popup only if the checkbox is checked
        if (agreeCheckbox.checked) {
            popupContainer.style.display = 'none';
            // Set session storage value to true
            sessionStorage.setItem('popupAgreed', 'true');
            // Remove the event listener after hiding the popup
            agreeButton.removeEventListener('click', hidePopup);
        } else {
            alert('Please agree to the terms and conditions.');
        }
    });

    // Retrieve the session storage value
    var popupAgreed = sessionStorage.getItem('popupAgreed');

    // Check if the popupAgreed value is set to true
    if (popupAgreed === 'true') {
        // Hide the popup if the user has already agreed
        popupContainer.style.display = 'none';
    } else {
        // Show the popup if the user has not agreed
        popupContainer.style.display = 'block';
    }

    // Function to hide the popup and set session storage value
    function hidePopup() {
        popupContainer.style.display = 'none';
        // Set session storage value to true
        sessionStorage.setItem('popupAgreed', 'true');
        // Remove the event listener after hiding the popup
        agreeButton.removeEventListener('click', hidePopup);
    }
});

// Get each input field by its ID
var firstNameInput = document.getElementById("register_name");
var middleNameInput = document.getElementById("register_middlename");
var lastNameInput = document.getElementById("register_lastname");

// Function to capitalize the first letter of each word
function capitalizeFirstLetter(value) {
    // Split the value by spaces
    var words = value.split(" ");

    // Capitalize each word
    for (var i = 0; i < words.length; i++) {
        words[i] = words[i].charAt(0).toUpperCase() + words[i].slice(1);
    }

    // Join the words back together with spaces
    return words.join(" ");
}

// Add event listener to the first name input field
firstNameInput.addEventListener("keyup", function(event) {
    event.target.value = capitalizeFirstLetter(event.target.value);
});

// Add event listener to the middle name input field
middleNameInput.addEventListener("keyup", function(event) {
    event.target.value = capitalizeFirstLetter(event.target.value);
});

// Add event listener to the last name input field
lastNameInput.addEventListener("keyup", function(event) {
    event.target.value = capitalizeFirstLetter(event.target.value);
});


function validateInput(input) {
    var errorName = document.getElementById("errorname");
    
    // Check if the input contains only numbers
    if (!isNaN(input.value)) {
        errorName.innerHTML = "Enter your real name.";
        errorName.style.display = "block";
        input.value = ""; // Clear the input field
        input.style.borderColor = "red"; // Change border color to red
        return false;
    } else {
        errorName.style.display = "none"; // Hide the error message
    }

    // Check for consecutive vowels or consonants exceeding 3
    var consecutiveVowels = /(a{3,}|e{3,}|i{3,}|o{3,}|u{3,})/i;
    var consecutiveConsonants = /(b{3,}|c{3,}|d{3,}|f{3,}|g{3,}|h{3,}|j{3,}|k{3,}|l{3,}|m{3,}|n{3,}|p{3,}|q{3,}|r{3,}|s{3,}|t{3,}|v{3,}|w{3,}|x{3,}|y{3,}|z{3,})/i;

    if (consecutiveVowels.test(input.value.toLowerCase()) || consecutiveConsonants.test(input.value.toLowerCase())) {
        errorName.innerHTML = "Enter your real name.";
        errorName.style.display = "block";
        input.value = ""; // Clear the input field
        input.style.borderColor = "red"; // Change border color to red
        return false;
    }else {
        errorName.style.display = "none"; // Hide the error message
    }

    // Check for consecutive numbers exceeding 3
    var consecutiveNumbers = /(\d{4,})/;
    if (consecutiveNumbers.test(input.value)) {
        errorName.innerHTML = "Enter your real name.";
        errorName.style.display = "block";
        input.value = ""; // Clear the input field
        input.style.borderColor = "red"; // Change border color to red
        return false;
    } else {
        errorName.style.display = "none"; // Hide the error message
    }

    // Check for consecutive same letters or numbers
    var consecutiveSameChars = /(.)\1{2,}/;
    if (consecutiveSameChars.test(input.value)) {
        errorName.innerHTML = "Enter your real name.";
        errorName.style.display = "block";
        input.value = ""; // Clear the input field
        input.style.borderColor = "red"; // Change border color to red
        return false;
    } else {
        errorName.style.display = "none"; // Hide the error message
    }

    // Check if name, middle name, or last name are written in more than three characters and follow the consecutive alphabet order
    var nameParts = input.value.trim().split(/\s+/);
    for (var i = 0; i < nameParts.length; i++) {
        var namePart = nameParts[i].toLowerCase();
        if (namePart.length > 2 && isConsecutiveAlphabeticalOrder(namePart)) {
            errorName.innerHTML = "Invalid input.";
            errorName.style.display = "block";
            input.value = ""; // Clear the input field
            input.style.borderColor = "red"; // Change border color to red
            return false;
        } else {
            errorName.style.display = "none"; // Hide the error message
        }
        if (namePart.length > 2 && isKeyboardStandardArrangement(namePart)) {
            errorName.innerHTML = "Invalid input.";
            errorName.style.display = "block";
            input.value = ""; // Clear the input field
            input.style.borderColor = "red"; // Change border color to red
            return false;
        } else {
            errorName.style.display = "none"; // Hide the error message
        }
        if (!isValidCharacter(namePart)) {
            errorName.innerHTML = "Invalid input. Only letters, numbers,  spaces, and dashes are allowed.";
            errorName.style.display = "block";
            input.value = ""; // Clear the input field
            input.style.borderColor = "red"; // Change border color to red
            return false;
        } else {
            errorName.style.display = "none"; // Hide the error message
        }
    }

    // Reset border color to default
    input.style.borderColor = ""; 

    return true; // Input is valid
}

// Function to check if a string is in consecutive alphabetical order
function isConsecutiveAlphabeticalOrder(str) {
    for (var i = 0; i < str.length - 2; i++) {
        var charCode1 = str.charCodeAt(i);
        var charCode2 = str.charCodeAt(i + 1);
        var charCode3 = str.charCodeAt(i + 2);
        
        // Check if consecutive characters in alphabet
        if (charCode1 + 1 === charCode2 && charCode2 + 1 === charCode3) {
            return true;
        }
    }
    return false;
}

// Function to check if a string follows the standard keyboard arrangement
function isKeyboardStandardArrangement(str) {
    var keyboardRows = ['qwertyuiop', 'asdfghjkl', 'zxcvbnm'];
    str = str.toLowerCase();
    for (var i = 0; i < keyboardRows.length; i++) {
        if (keyboardRows[i].includes(str)) {
            return true;
        }
    }
    return false;
}

// Function to check if input string contains valid characters
function isValidCharacter(str) {
    var validCharacters = /^[a-zA-Z\s\-]+$/;
    return validCharacters.test(str);
}

var $j = jQuery.noConflict();

function displayEmailUsedModal() {
    $j('#emailUsedModal').modal('show');
}

 // JavaScript to show/hide "Select Department" dropdown based on "Select User Type"
 function toggleDepartmentDropdown() {
    var userTypeDropdown = document.getElementById("userType");
    var departmentDropdown = document.getElementById("description");

    if (userTypeDropdown.value === "Faculty") {
        // If "Faculty" is selected, show the "Select Department" dropdown
        departmentDropdown.style.display = "block";
    } else {
        // Otherwise, hide the "Select Department" dropdown
        departmentDropdown.style.display = "none";
    }
}

// Function to validate email format
function validateEmail(email) {
    // Regular expression to validate email format
    var emailRegex = /^[a-zA-Z0-9._-]{6,}@((gmail\.com)|(bsu\.edu\.ph))$/;
    return emailRegex.test(email);
    
}

// Event listener for input event on email input
document.querySelector('input[name="email"]').addEventListener('blur', function() {
    var emailInput = this.value.trim(); // Trim whitespace from input value
    var emailError = document.getElementById("emailError");

    // Check if the input consists of only numbers before "@"
    if (/^\d+@/.test(emailInput)) {
        emailError.textContent = "Email address cannot start with numbers only.";
        emailError.style.display = "block"; // Display the error message
        // Change the border color to red since input is invalid
        this.style.borderColor = "red";
        // Clear the input value since it's invalid
        this.value = "";
    } else if (emailInput === "" || !validateEmail(emailInput)) {
        emailError.textContent = "Email address must be valid and end with '@gmail.com' or '@bsu.edu.ph'";
        emailError.style.display = "block"; // Display the error message
        // Change the border color to red since input is invalid
        this.style.borderColor = "red";
        // Clear the input value since it's invalid
        this.value = "";
    } else {
        emailError.textContent = ""; // Clear the error message
        emailError.style.display = "none"; // Hide the error message
        // Reset the border color
        this.style.borderColor = ""; // Revert back to default border color
    }
});



function togglePasswordVisibility() {
    var passwordInput = document.getElementById("registerEmail");
    var passwordToggle = document.getElementById("passwordToggle");

    if (passwordInput.type === "password") {
        passwordInput.type = "text";
        passwordToggle.innerHTML = '<i class="fa fa-eye-slash"></i>'; // Change icon to hide
    } else {
        passwordInput.type = "password";
        passwordToggle.innerHTML = '<i class="fa fa-eye"></i>'; // Change icon to show
    }
}

document.addEventListener("DOMContentLoaded", function () {
// Hide the password error message initially
var errorContainer = document.getElementById("passwordError");
errorContainer.style.display = "none";
});


function validatePassword() {
    const passwordInput = document.getElementById("registerEmail");
    const validatepassword = document.getElementById("validatepassword");

    // Reset error message and style
    validatepassword.textContent = "";
    passwordInput.classList.remove("invalid");
    passwordInput.style.borderColor = ""; // Reset border color

    // Check if the password input field is currently focused
    const isFocused = (document.activeElement === passwordInput);

    // Only perform validation if the password field is focused
    if (isFocused) {
        // Regular expressions for password requirements
        var lengthRegex = /.{8,}/;
        var uppercaseRegex = /[A-Z]/;
        var lowercaseRegex = /[a-z]/;
        var numberRegex = /[0-9]/;
        var specialCharRegex = /[!@#$%^&*()_+\-=\[\]{};':"\\|,.<>\/?]/;

        var errorMessage = "";

        // Check if password meets each requirement
        if (!lengthRegex.test(passwordInput.value)) {
            errorMessage += "Password must be at least 8 characters long. ";
        }
        if (!uppercaseRegex.test(passwordInput.value)) {
            errorMessage += "At least has uppercase letter. ";
        }
        if (!lowercaseRegex.test(passwordInput.value)) {
            errorMessage += "At least has lowercase letter. ";
        }
        if (!numberRegex.test(passwordInput.value)) {
            errorMessage += "At least has number. ";
        }
        if (!specialCharRegex.test(passwordInput.value)) {
            errorMessage += "At least has special character. ";
        }

        // Update error message container and display accordingly
        if (errorMessage === "") {
            // Password meets all requirements, hide error message
            validatepassword.textContent = "";
            validatepassword.style.display = "none";
        } else {
            // Password does not meet all requirements, show error message
            validatepassword.textContent = errorMessage;
            validatepassword.style.display = "block";
            passwordInput.classList.add("invalid");
            passwordInput.style.borderColor = "red"; // Set border color to red
            
        }
    }
}


function validateConfirmPassword() {
var password = document.getElementById("registerEmail").value;
var confirmPassword = document.getElementsByName("confirm_password")[0].value;
var confirmPwdInput = document.getElementsByName("confirm_password")[0];
var errorContainer = document.getElementById("passwordError");

if (confirmPassword !== password) {
    // Passwords don't match, show error message and highlight the field
    confirmPwdInput.classList.add("password-error");
    errorContainer.innerHTML = "Password don't match";
    errorContainer.style.display = "block"; // Show the error message
    input.value = ""; // Clear the input field
    return false;
} else {
    // Passwords match, reset the border color and clear error message
    confirmPwdInput.classList.remove("password-error");
    errorContainer.innerHTML = "";
    errorContainer.style.display = "none"; // Hide the error message
    return true;
}
}


function validateForm(event) {

    var password = document.getElementById("registerEmail").value;
    var confirmPassword = document.getElementsByName("confirm_password")[0].value;

    // Validation for registerEmail input
    var emailError = document.getElementById("emailError");
    var emailRegex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/;
    if (!emailRegex.test(password)) {
        document.getElementById("registerEmail").style.borderColor = "red";
        // Prevent the default form submission action
        event.preventDefault();
        return false;
    } else {
        emailError.textContent = ""; // Clear the error message
        emailError.style.display = "none"; // Hide the error message
        // Reset the border color
        document.getElementById("registerEmail").style.borderColor = ""; // Revert back to default border color
    }

    // Check if passwords match
    if (password !== confirmPassword) {
        // Prevent the default form submission action
        event.preventDefault();
        return false;
    }

    // Call validatePassword only if the user attempts to register
    if (password !== "" || confirmPassword !== "") {
        return validatePassword();
    }

    return true;
}

// Add event listener to the form submission event
document.getElementById("RegForm").addEventListener("submit", validateForm);