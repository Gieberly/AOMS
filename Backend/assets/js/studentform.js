// Default tab
$(".tab").css("display", "none");
$("#tab-1").css("display", "block");

// Initialize an array to keep track of completed steps
var completedSteps = [];


// Add an event listener to input fields and select elements
$("input, select").on("focus", function() {
  $(this).css("background", "#fff"); // Reset background color when focused
}).on("blur", function() {
  if ($(this).val() === "") {
    // If the field is empty, check if it's not among the specified fields
    var id = $(this).attr("id");
    if (id !== "middle_name" && id !== "zip_code" && id !== "contact_person_2" && id !== "contact_person_2_mobile" && id !== "relationship_2" && id !== "lrn") {
      $(this).css("border", "1px solid #ff0000");
      $(this).attr("placeholder", "Please fill up this field");
    }
  } else {
    // If the field is already filled, reset border color to default
    $(this).css("border", "1px solid #ccc"); // Change to your default border color
  }
});


function run(hideTab, showTab) {
  if (hideTab < showTab) { // If not pressing the previous button
    // Validation if pressing the next button
    var currentTab = 0;
    x = $('#tab-' + hideTab);
    y = $(x).find("input, select");

    function showAlert_SF(message) {
      var alertElement = document.getElementById("custom-alert_SF");
      alertElement.classList.add("show");
      alertElement.classList.remove("hidden");
      document.getElementById("alert-message_SF").innerText = message;
    
      setTimeout(function() {
        alertElement.classList.remove("show");
        alertElement.classList.add("hidden");
      }, 3000);
    }
    
    if (hideTab === 1) {


 // Check if Academic Classification is selected
 var academicClassification = $('#academic_classification_board').val();
 if (!academicClassification) {
  showAlert_SF("Please select Academic Classification before proceeding.");
   return false;
 }

      // Validate the checkbox in Tab 1
      if (!document.getElementById("read-guidelines").checked) {
        showAlert_SF("Please check the box to confirm that you have read the guidelines.");
        return false;
      }

    } else if (hideTab === 2) {
      // Handle the file input label click
      $('label[for="id_picture"]').click(function () {
          $('input[name="id_picture"]').click();
      });
  
      // Display the selected file name
      $('input[name="id_picture"]').change(function () {
          var fileName = $(this).val().split("\\").pop();
          $('label[for="id_picture"]').text(fileName);
      });
      var pictureInput = $('input[name="id_picture"]');
      if (pictureInput[0].files.length === 0) {
        showAlert_SF("Please upload an ID picture.");
          return false;
      }
  
      for (i = 0; i < y.length; i++) {
          // Check if the field is among those allowed to be empty
          if (y[i].id === "middle_name" || y[i].id === "Street_Permanent" || y[i].id === "zip_code" || y[i].id === "contact_person_2" || y[i].id === "contact_person_2_mobile" || y[i].id === "relationship_2" || y[i].id === "lrn") {
              continue; // Skip validation for this field
          }
  
          if (y[i].value.trim() === "") {
              // Handle empty fields with visual cues
              $(y[i]).css("border", "1px solid #ff0000");
              y[i].placeholder = "Please fill up all the field";
              y[i].focus();
              return false;
          }
      }
  }
  
    // Mark the step as completed
    completedSteps[hideTab - 1] = true;
  }

  // Progress bar
  for (i = 1; i < showTab; i++) {
    $("#step-" + i).css("opacity", "1");
    if (completedSteps[i - 1]) {
      $("#step-" + i).html('<i class="fas fa-check"></i>'); // Add a checkmark
    }
  }

  // Switch tab
  $("#tab-" + hideTab).css("display", "none");
  $("#tab-" + showTab).css("display", "block");
  $("input, select").css("background", "#fff");

  window.scrollTo(0, 0);
}

//Auto-capitalize each word ad Some Validations for mix word/number inputs
function capitalizeInput(inputId) {
  let input = document.getElementById(inputId);
  let inputValue = input.value;

  // Regular expression to match only letters, numbers, dashes, and spaces
  let validInput = /^[a-zA-Z0-9][a-zA-Z0-9 -]*$/;

  if (validInput.test(inputValue)) {
    let words = inputValue.split(' ');
    for (let i = 0; i < words.length; i++) {
      words[i] = words[i].charAt(0).toUpperCase() + words[i].slice(1).toLowerCase();
    }
    input.value = words.join(' ');
  } else {
    // Invalid input, do something (e.g., display error message)
    showAlert_SF("Input is invalid. It cannot start with a dash or space and can only contain letters, numbers, dashes, and spaces.");
    // You might also clear the input or handle it differently based on your requirements
    input.value = '';
  }
}

//Auto-capitalize each word and some validations for mixed word inputs
function capitalizeInput2(inputId) {
  let input = document.getElementById(inputId);
  let inputValue = input.value;

  // Regular expression to match only letters, dashes, and spaces
  let validInput = /^[a-zA-Z][a-zA-Z -]*$/;

  if (validInput.test(inputValue)) {
    let words = inputValue.split(' ');
    for (let i = 0; i < words.length; i++) {
      words[i] = words[i].charAt(0).toUpperCase() + words[i].slice(1).toLowerCase();
    }
    input.value = words.join(' ');
  } else {
    // Invalid input, do something (e.g., display error message)
    showAlert_SF("Input is invalid. It cannot start with a dash or space and can only contain letters, dashes, and spaces.");
    // You might also clear the input or handle it differently based on your requirements
    input.value = '';
  }
}




// Handle clicking the image preview to change the image
document.getElementById('id_picture_preview_container').addEventListener('click', function () {
  document.getElementById('id_picture').click();
});

// Handle the file input change event
document.getElementById('id_picture').addEventListener('change', function (e) {
  const fileInput = e.target;
  const imagePreview = document.getElementById('id_picture_preview_img');
  const uploadInstructions = document.getElementById('upload-instructions');

  if (fileInput.files.length > 0) {
    const file = fileInput.files[0];

    // Check if the file size exceeds 5MB
    const maxSizeInBytes = 5 * 1024 * 1024; // 5MB in bytes
    if (file.size > maxSizeInBytes) {
      showAlert_SF("Please upload a picture with a size less than 5MB.");
      // Optionally, you may want to clear the file input or take other actions
      fileInput.value = ''; // Clear the file input
      return false;
    }
    // Display the selected file as the image preview
    const reader = new FileReader();
    reader.onload = function (e) {
      imagePreview.src = e.target.result;

      // Hide the upload instructions
      uploadInstructions.style.display = 'none';
    };
    reader.readAsDataURL(file);
  }
});



function BoardRequirements() {
  var classificationDropdown = document.getElementById("academic_classification_board");
  var classificationInfoContainer = document.getElementById("classificationInfo");
  var academicClassificationInput = document.getElementById("academic_classification"); // Add this line

  // Check if a classification is selected
  if (classificationDropdown.value !== "") {
    // Display the corresponding information based on the selected classification
    switch (classificationDropdown.value) {
      case "Senior High School Graduate":
        classificationInfoContainer.innerHTML = `
          <ol type="I"  class="custom-list">
          <h3>Requirements to Submit</h3>
            <strong>
              <li>Senior High School Graduates who did not enroll in any college degree
                program/technical/vocational/degree
                program in any other school after graduation and will only enroll for the immediately following School
                Year:</li>
            </strong>
            <ol class="rac-list" type="a">
              <li>Photocopy /scanned copy of PSA (formerly NSO) Birth Certificate</li>
              <li>Photocopy /scanned copy of PSA (formerly NSO) Marriage Certificate for married females using the
                family
                name/surname of the husband</li>
              <li>Hard copy two (2) 2x2 recent formal studio "type" photo with
                nametag and signature</li>
              <li>Certified true copy of Grade 12 Report Card. Photocopy /scanned copy will suffice if the applicant can
                present the original copy for comparison purposes.</li>
              <li>Certification of Enrollment from the last school attended.</li>
            </ol>
          </ol>`;
        break;
        case "High School (Old Curriculum) Graduate":
          classificationInfoContainer.innerHTML = `
          <ol type="I"  class="custom-list">
          <h3>Requirements to Submit</h3>
            <strong>
                <li>High School Graduate of the Old High School curriculum who did not enroll in any college degree
                  program
                  in any other school after graduation from high school and will only enroll this S.Y. 2021-2022:</li>
              </strong>
              <ol class="rac-list" type="a">
                <li>Photocopy /scanned copy of PSA (formerly NSO) Birth Certificate</li>
                <li>Photocopy /scanned copy of PSA (formerly NSO) Marriage Certificate for married females using the
                  family
                  name/surname of the husband</li>
                <li>Hard copy two (2) 2x2 recent formal studio "type" photo with
                  nametag and signature
                </li>
                <li>Certified true copy of High School Card/Form 138. Photocopy /scanned copy will suffice if the
                  applicant
                  can present the original copy for comparison purposes.</li>
                <li>Certification of Enrollment from the last school attended.</li>
              </ol>
            </ol>`;
          break;
          case "Currently enrolled as Grade 12":
            classificationInfoContainer.innerHTML = `
            <ol type="I"  class="custom-list">
            <h3>Requirements to Submit</h3>
              <strong>
              <li>Grade 12 as of application period (Currently enrolled as Grade 12):</li>
          </strong>
          <ol class="rac-list" type="a">
            <li>Photocopy /scanned copy of PSA (formerly NSO) Birth Certificate</li>
            <li>Photocopy /scanned copy of PSA (formerly NSO) Marriage Certificate for married females using the
              family
              name/surname of the husband</li>
            <li>Hard copy One (2) 2x2 recent formal studio "type" photo with
              nametag and signature
            </li>
            <li>Certified photocopy of Grade 11 Card</li>
            <li>Certification of Enrollment from the last school attended.</li>
          </ol>
              </ol>`;
            break;
          case "ALS/PEPT Completer":
            classificationInfoContainer.innerHTML = `
            <ol type="I"  class="custom-list">
            <h3>Requirements to Submit</h3>
              <strong>
              <li>ALS/PEPT Completer:</li>
          </strong>
          <ol class="rac-list" type="a">
            <li>Photocopy /scanned copy of PSA (formerly NSO) Birth Certificate</li>
            <li>Photocopy /scanned copy of PSA (formerly NSO) Marriage Certificate for married females using the
              family
              name/surname of the husband</li>
            <li>Hard copy two (2) 2x2 recent formal studio "type" photo with
              nametag and signature
            </li>
            <li>Certified true copy ALS Certificate of Rating – For completers of Alternative Learning System (ALS) OR
              PEPT. Photocopy /scanned copy will suffice if the applicant can present the original copy for comparison
              purposes.</li>
            <li>Certification of Enrollment from the last school attended.</li>
          </ol>
              </ol>`;
            break;
            case "Transferee":
            classificationInfoContainer.innerHTML = `
            <ol type="I"  class="custom-list">
            <h3>Requirements to Submit</h3>
              <strong>
              <li>Transferee:</li>
          </strong>
          <ol class="rac-list" type="a">
            <li>Photocopy /scanned copy of PSA (formerly NSO) Birth Certificate</li>
            <li>Photocopy /scanned copy of PSA (formerly NSO) Marriage Certificate for married females using the
              family
              name/surname of the husband</li>
            <li>Hard copy two (2) 2x
            <li>Photocopy /scanned copy of PSA (formerly NSO) Birth Certificate</li>
            <li>Photocopy /scanned copy of PSA (formerly NSO) Marriage Certificate for married females using the
              family
              name/surname of the husband</li>
            <li>Hard copy two (2) 2x2 recent formal studio "type" photo with
              nametag and signature
            </li>
            <li>Certified true copy of Copy of Grades or Transcript of Records (Applicable only for Second Degree
              Transferees). Photocopy /scanned copy will suffice if the applicant can present the original copy for
              comparison purposes.</li>
            <li>Certification of Enrollment from the last school attended or presently enrolled in.</li>
            <li>Certification of General Weighted Average (GWA) issued by the Registrar's Office/equivalent Office of
              your previous School.</li>
          </ol>
              </ol>`;
            break;
            case "Second Degree":
              classificationInfoContainer.innerHTML = `
              <ol type="I"  class="custom-list">
              <h3>Requirements to Submit</h3>
                <strong>
                <li>Second Degree:</li>
                </strong>
                <ol class="rac-list" type="a">
                  <li>Photocopy /scanned copy of PSA (formerly NSO) Birth Certificate</li>
                  <li>Photocopy /scanned copy of PSA (formerly NSO) Marriage Certificate for married females using the
                    family
                    name/surname of the husband</li>
                  <li>Hard copy two (2) 2x2 recent formal studio "type" photo with
                    nametag and signature
                  </li>
                  <li>Certified true copy of Copy of Grades or Transcript of Records (Applicable only for Second Degree
                    Transferees). Photocopy /scanned copy will suffice if the applicant can present the original copy for
                    comparison purposes.</li>
                  <li>Photocopy/scanned copy of Grades or Transcript of Records for graduates Where BSU is the last school
                    attended</li>
                  <li>Certification of Enrollment from the last school attended or presently enrolled in.</li>
                  <li>Certification of General Weighted Average (GWA) issued by the Registrar's Office/equivalent Office of
                    your previous School.</li>
                </ol>
                </ol>`;
              break;
              default:
                classificationInfoContainer.innerHTML = ""; // Clear the info container if no match
            }
        
            // Update the value of the academic_classification input field
            academicClassificationInput.value = classificationDropdown.value; // Add this line
          } else {
            // Clear the info container if no classification is selected
            classificationInfoContainer.innerHTML = "";
            academicClassificationInput.value = ""; // Clear the input field value if no classification is selected
          }
        }


function updateApplicantName() {
  // Get values from the input fields
  var lastName = document.getElementById('last_name').value;
  var firstName = document.getElementById('first_name').value;
  var middleName = document.getElementById('middle_name').value;

  // Concatenate the values and set them to the "Name of Applicant" field
  var fullName = lastName + ', ' + firstName + ' ' + middleName;
  document.getElementById('applicant_name').value = fullName;
}

function calculateAge() {
  var birthdateInput = document.getElementById("birthdate");
  var ageInput = document.getElementById("age");

  if (birthdateInput.value) {
    var birthdate = new Date(birthdateInput.value);
    var today = new Date();
    var age = today.getFullYear() - birthdate.getFullYear();

    // Check if birthday has occurred this year
    if (today.getMonth() < birthdate.getMonth() || (today.getMonth() === birthdate.getMonth() && today.getDate() < birthdate.getDate())) {
      age--;
    }

    ageInput.value = age;
   
}
}

function showAlert_SF(message) {
  var alertElement = document.getElementById("custom-alert_SF");
  alertElement.classList.add("show");
  alertElement.classList.remove("hidden");
  document.getElementById("alert-message_SF").innerText = message;

  setTimeout(function() {
    alertElement.classList.remove("show");
    alertElement.classList.add("hidden");
  }, 3000);
}

function validateBirthdate() {
  var birthdateInput = document.getElementById('birthdate').value;
  var birthdate = new Date(birthdateInput);
  var currentDate = new Date();
  var minBirthdate = new Date();
  minBirthdate.setFullYear(currentDate.getFullYear() - 15); // Subtract 10 years from the current date

  if (birthdate > minBirthdate) {
      // If the birthdate entered is less than 10 years from the current date
      showAlert_SF("You must be at least 15 years old to register.");
      document.getElementById('birthdate').value = ''; // Clear the input field
  }
}

// function validatePhoneNumber(inputId) {
//   var phoneInput = document.getElementById(inputId);
//   var phoneError = document.getElementById(inputId + "-error");

//   // Regular expression for a valid Philippine mobile number
//   var regex = /^(09|\+639)\d{9}$/;

//   if (!regex.test(phoneInput.value)) {
//     phoneError.innerHTML = "Please enter a valid Philippine mobile number.";
//   } else {
//     phoneError.innerHTML = "";
//   }
// }
function validateLRN(input) {
  // Remove non-numeric characters
  let inputValue = input.value.replace(/\D/g, '');

  // Limit the input to 12 digits
  inputValue = inputValue.slice(0, 12);

  // Update the input value
  input.value = inputValue;

  // Validate input length and update border and error message
  const lrnInput = document.getElementById("lrn");
  const lrnNote = document.getElementById("lrn_note");
  if (inputValue.length < 12) {
      lrnInput.style.borderColor = "red";
      lrnNote.textContent = "Invalid input (must be 12 digits)";
      lrnNote.classList.add("error"); // Add the error class
  } else {
      lrnInput.style.borderColor = "initial";
      lrnNote.textContent = "";
      lrnNote.classList.remove("error"); // Remove the error class (optional)
  }
}

document.addEventListener("DOMContentLoaded", function() {
  var lastNameInput = document.getElementById("last_name");
  var firstNameInput = document.getElementById("first_name");
  var middleNameInput = document.getElementById("middle_name");
  var CitizenshipInput = document.getElementById("citizenship");
  var BirthplaceMunicipalityInput = document.getElementById("Municipality_birthplace");
  var BirthplaceProvinceInput = document.getElementById("Province_birthplace");
  var BirthplaceCountryInput = document.getElementById("Country_birthplace");
  var StreetAddressInput = document.getElementById("Street_Permanent");
  var SubdivisionAddressInput = document.getElementById("Subdivision_Permanent");
  var TownAddressInput = document.getElementById("Town_Permanent");
  var ProvinceAddressInput = document.getElementById("Province_Permanent");
  var CountryAddressInput = document.getElementById("Country_Permanent");
  var zipCodeInput = document.getElementById("zip_code");
  var FacebookInput = document.getElementById("facebook");
  var conName1Input = document.getElementById("contact_person_1");
  var conName2Input = document.getElementById("contact_person_2");;
  var lastSchoolInput = document.getElementById("School_Name");
  var BarangaySchoolInput = document.getElementById("Barangay_School");
  var MunicipalitySchoolInput = document.getElementById("Municipality_School");
  var ProvinceSchoolInput = document.getElementById("Province_School");
  var lrnInput = document.getElementById("lrn");
 
  var lastNameNote = document.getElementById("last_name_note");
  var firstNameNote = document.getElementById("first_name_note");
  var middleNameNote = document.getElementById("middle_name_note");
  var CitizenshipNote = document.getElementById("citizenship_note");
  var BirthplaceMunicipalityNote = document.getElementById("Municipality_birthplace_note");
  var BirthplaceProvinceNote = document.getElementById("Province_birthplace_note");
  var BirthplaceCountryNote = document.getElementById("Country_birthplace_note");
  var StreetAddressNote = document.getElementById("Street_Permanent_note");
  var SubdivisionAddressNote = document.getElementById("Subdivision_Permanent_note");
  var TownAddressNote = document.getElementById("Town_Permanent_note");
  var ProvinceAddressNote = document.getElementById("Province_Permanent_note");
  var CountryAddressNote = document.getElementById("Country_Permanent_note");
  var zipCodeNote = document.getElementById("zip_code_note");
  var FacebookNote = document.getElementById("facebook_note");
  var conName1Note = document.getElementById("contact_person_1_note");
  var conName2Note = document.getElementById("contact_person_2_note");
  var lastSchoolNote = document.getElementById("School_Name_note");
  var BarangaySchoolNote = document.getElementById("Barangay_School_note");
  var MunicipalitySchoolNote = document.getElementById("Municipality_School_note");
  var ProvinceSchoolNote = document.getElementById("Province_School_note");
  var lrnNote = document.getElementById("lrn_note");

  lastNameInput.addEventListener("focus", function() {
    hideAllPlaceholderExamples();
    displayPlaceholderExample(lastNameNote);
  });
  
  firstNameInput.addEventListener("focus", function() {
    hideAllPlaceholderExamples();
    displayPlaceholderExample(firstNameNote);
  });
  
  middleNameInput.addEventListener("focus", function() {
    hideAllPlaceholderExamples();
    displayPlaceholderExample(middleNameNote);
  });

  CitizenshipInput.addEventListener("focus", function() {
    hideAllPlaceholderExamples();
    displayPlaceholderExample(CitizenshipNote);
  });

  BirthplaceMunicipalityInput.addEventListener("focus", function() {
    hideAllPlaceholderExamples();
    displayPlaceholderExample(BirthplaceMunicipalityNote);
  });

  BirthplaceProvinceInput.addEventListener("focus", function() {
    hideAllPlaceholderExamples();
    displayPlaceholderExample(BirthplaceProvinceNote);
  });

  BirthplaceCountryInput.addEventListener("focus", function() {
    hideAllPlaceholderExamples();
    displayPlaceholderExample(BirthplaceCountryNote);
  });

  StreetAddressInput.addEventListener("focus", function() {
    hideAllPlaceholderExamples();
    displayPlaceholderExample(StreetAddressNote);
  });

  SubdivisionAddressInput.addEventListener("focus", function() {
    hideAllPlaceholderExamples();
    displayPlaceholderExample(SubdivisionAddressNote);
  });

  TownAddressInput.addEventListener("focus", function() {
    hideAllPlaceholderExamples();
    displayPlaceholderExample(TownAddressNote);
  });

  ProvinceAddressInput.addEventListener("focus", function() {
    hideAllPlaceholderExamples();
    displayPlaceholderExample(ProvinceAddressNote);
  });

  CountryAddressInput.addEventListener("focus", function() {
    hideAllPlaceholderExamples();
    displayPlaceholderExample(CountryAddressNote);
  });

  zipCodeInput.addEventListener("focus", function() {
    hideAllPlaceholderExamples();
    displayPlaceholderExample(zipCodeNote);
  });

  FacebookInput.addEventListener("focus", function() {
    hideAllPlaceholderExamples();
    displayPlaceholderExample(FacebookNote);
  });

  conName1Input.addEventListener("focus", function() {
    hideAllPlaceholderExamples();
    displayPlaceholderExample(conName1Note);
  });

  conName2Input.addEventListener("focus", function() {
    hideAllPlaceholderExamples();
    displayPlaceholderExample(conName2Note);
  });

  lastSchoolInput.addEventListener("focus", function() {
    hideAllPlaceholderExamples();
    displayPlaceholderExample(lastSchoolNote);
  });

  BarangaySchoolInput.addEventListener("focus", function() {
    hideAllPlaceholderExamples();
    displayPlaceholderExample(BarangaySchoolNote);
  });

  MunicipalitySchoolInput.addEventListener("focus", function() {
    hideAllPlaceholderExamples();
    displayPlaceholderExample(MunicipalitySchoolNote);
  });

  ProvinceSchoolInput.addEventListener("focus", function() {
    hideAllPlaceholderExamples();
    displayPlaceholderExample(ProvinceSchoolNote);
  });

  lrnInput.addEventListener("focus", function() {
    hideAllPlaceholderExamples();
    displayPlaceholderExample(lrnNote);
  });

  function displayPlaceholderExample(placeholder) {
    placeholder.style.display = "block";
  }

  function hidePlaceholderExample(placeholder) {
    placeholder.style.display = "none";
  }

  function hideAllPlaceholderExamples() {
    var allPlaceholderExamples = document.querySelectorAll(".note");
    allPlaceholderExamples.forEach(function(placeholder) {
      hidePlaceholderExample(placeholder);
    });
  }
});

const inputIds = ['phone_number', 'contact1_phone', 'contact_person_2_mobile'];

for (const id of inputIds) {
  const inputElement = document.getElementById(id);
  if (inputElement) {
    inputElement.addEventListener('input', function() {
      var inputValue = this.value;
      // Regular expression to match only digits (0-9)
      var onlyNumbers = /^\d+$/;
      // Test if the input matches the regular expression
      if (!onlyNumbers.test(inputValue)) {
        // If input doesn't match, clear the input field (or provide an error message)
        this.value = '';  // This clears the field
        // Alternatively, you can display an error message:
        // this.classList.add('error'); // Add an error class for styling
      } else {
        // Optionally, remove any previous error styling
        this.classList.remove('error');
      }
    });
  }
}

var input1 = document.querySelector("#phone_number");
var input2 = document.querySelector("#contact1_phone");
var input3 = document.querySelector("#contact_person_2_mobile");

function initializeTelInput(input) {
  var iti = window.intlTelInput(input, {
    initialCountry: "ph",
    separateDialCode: true,
    utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.12/js/utils.js"
  });

  input.addEventListener('change', function() {
    var selectedCountryData = iti.getSelectedCountryData();
    var formattedNumber = iti.getNumber(intlTelInputUtils.numberFormat.E164);
    input.value = formattedNumber;

    // Dynamically set maxlength based on the phone number format of the selected country
    var phoneLength = selectedCountryData.dialCode.length + selectedCountryData.format.replace(/\D/g, '').length;
    input.setAttribute('maxlength', phoneLength);
  });
}

initializeTelInput(input1);
initializeTelInput(input2);
initializeTelInput(input3);


// Store initial options fetched from PHP in an array
var initialOptions = [];

// Loop through the options and populate the array
var selectOptions = document.getElementById("ethnicity").getElementsByTagName("option");
for (var i = 0; i < selectOptions.length; i++) {
    initialOptions.push(selectOptions[i].outerHTML);
}

function handleEthnicityChange() {
    var selectBox = document.getElementById("ethnicity");
    var selectedValue = selectBox.options[selectBox.selectedIndex].value;
    if (selectedValue.toLowerCase() === "others") {
        var textBox = document.createElement("input");
        textBox.type = "text";
        textBox.className = "input";
        textBox.id = "ethnicityInput"; // Change the id to avoid conflicts
        textBox.name = "ethnicity";
        textBox.required = true;
        textBox.placeholder = "Enter Ethnicity";
        textBox.addEventListener("input", function(event) {
            var value = event.target.value;
            // Capitalize first letter of each word
            event.target.value = value.replace(/\b\w/g, function(txt) {
                return txt.charAt(0).toUpperCase() + txt.substr(1).toLowerCase();
            });
        });
        textBox.addEventListener("keypress", function(event) {
            var key = event.keyCode;
            // Allow only letters, spaces, and dashes
            if (!((key >= 65 && key <= 90) || (key >= 97 && key <= 122) || key === 32 || key === 45)) {
                event.preventDefault();
            }
        });
        selectBox.parentNode.replaceChild(textBox, selectBox);

        // Add a blur event listener to check if the input is left empty
        textBox.addEventListener("blur", function() {
            if (textBox.value.trim() === "") {
                var selectBox = document.createElement("select");
                selectBox.name = "ethnicity";
                selectBox.className = "input";
                selectBox.id = "ethnicity";
                selectBox.required = true;
                selectBox.onchange = handleEthnicityChange;

                // Add initial options back to the dropdown
                for (var i = 0; i < initialOptions.length; i++) {
                    selectBox.innerHTML += initialOptions[i];
                }

                textBox.parentNode.replaceChild(selectBox, textBox);
            }
        });
    }
}

function updateBirthplace() {
  var countryBirthplace = document.getElementById("Country_birthplace").value;
  var provinceBirthplace = document.getElementById("Province_birthplace").value;
  var municipalityBirthplace = document.getElementById("Municipality_birthplace").value;
  var birthplaceInput = document.getElementById("birthplace");

  birthplaceInput.value = municipalityBirthplace + ", " + provinceBirthplace + ", " + countryBirthplace;
}

function updatePermanentAddress() {
  var streetPermanentAddress = document.getElementById("Street_Permanent").value;
  var subdivisionPermanentAddress = document.getElementById("Subdivision_Permanent").value;
  var townPermanentAddress = document.getElementById("Town_Permanent").value;
  var provincePermanentAddress = document.getElementById("Province_Permanent").value;
  var countryPermanentAddress = document.getElementById("Country_Permanent").value;
  var permanentaddressInput = document.getElementById("permanent_address");

  permanentaddressInput.value = streetPermanentAddress + ", " + subdivisionPermanentAddress + ", " + townPermanentAddress + ", " + provincePermanentAddress + ", " + countryPermanentAddress;
}

function updateLastSchoolAttended() {
  var shoolnameLastSchoolAttended = document.getElementById("School_Name").value;
  var barangayLastSchoolAttended = document.getElementById("Barangay_School").value;
  var municipalityLastSchoolAttended = document.getElementById("Municipality_School").value;
  var provinceLastSchoolAttended = document.getElementById("Province_School").value;
  var schooladdressInput = document.getElementById("high_school_name_address");

  schooladdressInput.value = shoolnameLastSchoolAttended + ", " + barangayLastSchoolAttended + ", " + municipalityLastSchoolAttended + ", " + provinceLastSchoolAttended;
}

function validateInput(input) {
  // Regular expressions to check if input contains only numbers, vowels, or consonants
  var numbersPattern = /^[0-9]+$/;
  var vowelsPattern = /^[aeiou]+$/i;
  var consonantsPattern = /^[bcdfghjklmnpqrstvwxyz]+$/i;

  if (input.match(numbersPattern)) {
    return "Input cannot contain numbers only.";
  } else if (input.match(vowelsPattern)) {
    return "Input cannot contain vowels only.";
  } else if (input.match(consonantsPattern)) {
    return "Input cannot contain consonants only.";
  } else {
    return ""; // Input is valid
  }
}

//Preview Popup Fetch Inputs
function PreviewInput() {
  // Get the values from Name fields
  var first_name = document.getElementById('first_name').value;
  var middle_name = document.getElementById('middle_name').value;
  var last_name = document.getElementById('last_name').value;

  var gender = document.getElementById('gender').value;
  var birthdate = document.getElementById('birthdate').value;
  var age = document.getElementById('age').value;
  var civil_status = document.getElementById('civil_status').value;
  var citizenship = document.getElementById('citizenship').value;
  var ethnicity = document.getElementById('ethnicity').value;

  // Get the values from birthplace fields
  var Municipality_birthplace = document.getElementById('Municipality_birthplace').value;
  var Province_birthplace = document.getElementById('Province_birthplace').value;
  var Country_birthplace = document.getElementById('Country_birthplace').value;

  // Get the values from Address fields
  var Street_Permanent = document.getElementById('Street_Permanent').value;
  var Subdivision_Permanent = document.getElementById('Subdivision_Permanent').value;
  var Town_Permanent = document.getElementById('Town_Permanent').value;
  var Province_Permanent = document.getElementById('Province_Permanent').value;
  var Country_Permanent = document.getElementById('Country_Permanent').value;

  var zip_code = document.getElementById('zip_code').value;
  var phone_number = document.getElementById('phone_number').value;
  var facebook = document.getElementById('facebook').value;
  var email = document.getElementById('email').value;
  var contact_person_1 = document.getElementById('contact_person_1').value;
  var contact1_phone = document.getElementById('contact1_phone').value;
  var relationship_1 = document.getElementById('relationship_1').value;
  var contact_person_2 = document.getElementById('contact_person_2').value;
  var contact_person_2_mobile = document.getElementById('contact_person_2_mobile').value;
  var relationship_2 = document.getElementById('relationship_2').value;
  var academic_classification = document.getElementById('academic_classification').value;

  // Get the values from School fields
  var School_Name = document.getElementById('School_Name').value;
  var Barangay_School = document.getElementById('Barangay_School').value;
  var Municipality_School = document.getElementById('Municipality_School').value;
  var Province_School = document.getElementById
  ('Province_School').value;

  var degree_applied = document.getElementById('degree_applied').value;
  var nature_of_degree = document.getElementById('nature_of_degree').value;
  var lrn = document.getElementById('lrn').value;

  // Combine the values to form the Name
  var FullName_Preview = first_name + ' ' + middle_name + ' ' + last_name;
  // Combine the values to form the birthplace
  var Birthplace_Preview = Municipality_birthplace + ', ' + Province_birthplace + ', ' + Country_birthplace;
  // Combine the values to form the address
  var Address_Preview = Street_Permanent + ', ' + Subdivision_Permanent + ', ' + Town_Permanent + ', ' + Province_Permanent + ', ' + Country_Permanent ;
  // Combine the values to form the school
  var School_Preview = School_Name + '/ ' + Barangay_School + ', ' + Municipality_School + ', ' + Province_School;


  // Set the value of the Name input field
  document.getElementById('applicant_name_preview').value = FullName_Preview;

  document.getElementById('gender_preview').value = gender;
  document.getElementById('birthdate_preview').value = birthdate;
  document.getElementById('age_preview').value = age;
  document.getElementById('civil_status_preview').value = civil_status;
  document.getElementById('citizenship_preview').value = citizenship;
  document.getElementById('ethnicity_preview').value = ethnicity;

  // Set the value of the birthplace input field
  document.getElementById('Birthplace_Preview').value = Birthplace_Preview;
  // Set the value of the address input field
  document.getElementById('permanent_address_preview').value = Address_Preview;

  document.getElementById('zip_code_preview').value = zip_code;
  document.getElementById('phone_preview').value = phone_number;
  document.getElementById('facebook_preview').value = facebook;
  document.getElementById('email_preview').value = email;
  document.getElementById('contact1_preview').value = contact_person_1;
  document.getElementById('contactperson1_preview').value = contact1_phone;
  document.getElementById('relationship1_preview').value = relationship_1;
  document.getElementById('contact2_preview').value = contact_person_2;
  document.getElementById('contactperson2_preview').value = contact_person_2_mobile;
  document.getElementById('relationship2_preview').value = relationship_2;
  document.getElementById('academic_classification_preview').value = academic_classification;

  document.getElementById('degree_applied_preview').value = degree_applied;
  document.getElementById('nature_of_degree_preview').value = nature_of_degree;
  document.getElementById('lrn_preview').value = lrn;
  document.getElementById('high_school_preview').value = School_Preview;
}


