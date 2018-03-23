var validateField = function(fieldElem, infoMessage, validateFn) {
  // Add the span if there already isnt one
  if ($(fieldElem).next().length === 0) {
    $(fieldElem).after("<span>" + infoMessage + "<span>");
  }

  // Default hidden
  $(fieldElem).siblings().hide();

  // Change class to info while editing
  $(fieldElem).on("keyup", (function() {
    console.log("editing");
    $(fieldElem).siblings().text(infoMessage);
    $(fieldElem).siblings().removeClass();
    $(fieldElem).siblings().addClass("info");

  }))
  // If element doesnt validate
  if (validateFn == false) {
    console.log("Does not validate");
    $(fieldElem).siblings().text("Error");
    $(fieldElem).siblings().show();
    $(fieldElem).siblings().removeClass();
    $(fieldElem).siblings().addClass("error");
  }
  // If element doesnt is empty
  if ($(fieldElem).val().length === 0 ) {
   $(fieldElem).siblings().hide();
   $(fieldElem).siblings().removeClass();
 }
 // If element does validate
  if (validateFn == true) {
    console.log("Does validate");
    $(fieldElem).siblings().text("Okay");
    $(fieldElem).siblings().show();
    $(fieldElem).siblings().removeClass();
    $(fieldElem).siblings().addClass("ok");
}
};

$(document).ready(function() {
  // Validate every field
  $("#firstname").on("blur", (function() {validateField($(this), "Alphabet only",
    validateName($("#firstname").val()))
  }));
  $("#lastname").on("blur", (function() {validateField($(this), "Alphabet only",
    validateName($("#lastname").val()))
  }));
  $("#city").on("blur", (function() {validateField($(this), "Alphabet only",
    validateName($("#city").val()))
  }));
  $("#state").on("blur", (function() {validateField($(this), "Alphabet only",
    validateState($("#state").val()))
  }));
  $("#phone").on("blur", (function() {validateField($(this), "Number must be in XXX-XXX-XXXX format",
    validateNumber($("#phone").val()))
  }));
  $("#email").on("blur", (function() {validateField($(this), "Use standard email format",
    validateEmail($("#email").val()))
  }));
  $("#street").on("blur", (function() {validateField($(this), "Use standard address form",
    validateAddr($("#street").val()))
  }));
  $("#scoutname").on("blur", (function() {validateField($(this), "Alphabet only, > 3 chars",
    validateScout($("#scoutname").val()))
  }));
  $("#troop").on("blur", (function() {validateField($(this), "Alphabet only",
    validateName($("#troop").val()))
  }));
  $("#zipcode").on("blur", (function() {validateField($(this), "Enter a correct zip",
    validateZip($("#zipcode").val()))
  }));
});
// Validation functions for element e:

// Name must be alphabetic
function validateName(e) {
  var re = /^[a-zA-Z]+$/;
  return re.test(e);
}
function validateScout(e) {
  var re = /^[a-zA-Z]+$/;
  return re.test(e) && e.length > 3;
}
// Phone number must be in form xxx-xxx-xxxx or xxxxxxxxxx
function validateNumber(e) {
  var re = /^\(?([0-9]{3})\)?[-.●]?([0-9]{3})[-.●]?([0-9]{4})$/;
  return re.test(e);
}
// Password must be alphanumeric with at least 1 number
 function validatePassword(e) {
  var re = /(?=.*[0-9])[a-zA-Z]/;
  return re.test(e);
}
// Email must be in form xxx@xxxxx.xxx
var validateEmail = function (e) {
  var re = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
  return re.test(e);
}
// Validates address in 101 apple street
var validateAddr = function (e) {
  var re = /^\d+\s[A-z]+\s[A-z]+$/
  return re.test(e);
}
// Validates zip 11111-99999
var validateZip = function (e) {
  var re = /^\d{5}(?:[-\s]\d{4})?$/
  return re.test(e);
}
// Validates state exists and is only alphabetic
function validateState(e) {
  var re = /^[a-zA-Z]+$/;
  var test1 = re.test(e);
  // compare lower case states to lower case input
  var test2 = $.inArray(e.toLowerCase(), statesLower) > -1;
  return test1 && test2;
}

// Call on submit. Validates checkbox and radio selection, and
// makes sure all other fields are of class ok
function revalidate(state) {
    if ($(".ok").size() != 10) {
      alert("Please fill in every box and fix mistakes.");
      return false;
    }
}


var states = Array(
"Alabama", "Alaska", "Arizona", "Arkansas",
"California", "Colorado", "Connecticut", "Delaware",
"District of Columbia", "Florida", "Georgia", "Hawaii",
"Idaho", "Illinois", "Indiana", "Iowa", "Kansas", "Kentucky",
"Louisiana", "Maine", "Maryland", "Massachusetts", "Michigan",
"Minnesota", "Mississippi", "Missouri", "Montana", "Nebraska",
"Nevada", "New Hampshire", "New Jersey", "New Mexico", "New York",
"North Carolina", "North Dakota", "Ohio", "Oklahoma", "Oregon",
"Pennsylvania", "Rhode Island", "South Carolina", "South Dakota",
"Tennessee", "Texas", "Utah", "Vermont", "Virginia", "Washington",
"West Virginia", "Wisconsin", "Wyoming");

// Lower case states
var statesLower = [];
for (var i = 0; i < states.length; i++) {
  statesLower.push(states[i].toLowerCase());
}
