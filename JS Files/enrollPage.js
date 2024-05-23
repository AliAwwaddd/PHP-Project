


$(document).ready(function () {

// names of failed courses to compare them with the new courses
var failedCourses = [];
var failedCredits;
let flag;
let numberOfLinkedCourses = 0;

var checkboxes = document.getElementsByClassName("course-checkbox");
failedCourses = checkboxes[0].getAttribute("failedCNames").split(",");
failedCredits = checkboxes[0].getAttribute("failedCredits");
let nbOfFailedCourses = failedCourses.length;
flag = nbOfFailedCourses;

// document.getElementsByClassName("div1")[0].innerHTML = flag;

for (var i = flag; i < checkboxes.length; i++) {
	if (hasSameNameAsFailedCourse(checkboxes[i], failedCourses)) {
		numberOfLinkedCourses++;
		checkboxes[i].disabled = true;
	}
	checkboxes[i].addEventListener("change", updateTotalCredits);
}

// Add an event listener for the form submission
var form = document.querySelector("form");
form.addEventListener("submit", function (event) {
	var totalCredits = parseInt(
		document.getElementById("totalCredits").innerText
	);

	// Check if total credits are less than 30
	if (totalCredits < 30) {
		// Prevent form submission

		alert("You cannot enroll with less than 30 credits.");
		event.preventDefault();
	}
});

// Function to update the total credits
function updateTotalCredits() {
	var totalCredits = parseInt(failedCredits);

	for (var i = nbOfFailedCourses; i < checkboxes.length; i++) {
		if (checkboxes[i].checked) {
			totalCredits += parseInt(checkboxes[i].getAttribute("data-credits"));
		}
	}

	// Check if total credits exceed 36
	if (totalCredits > 36) {
		// Disable the last checked checkbox
		this.checked = false;
		// Alternatively, you can display a message to the user
		alert("You cannot choose more than 36 credits.");
		totalCredits -= parseInt(checkboxes[i].getAttribute("data-credits"));
	}

	// Update the total credits display
	document.getElementById("totalCredits").innerText = totalCredits;

	let nbCheckedBoxes = 0;
	let nbOfBoxes = checkboxes.length;
	let flag3 = 0;

	for (var i = 0; i < nbOfBoxes; i++) {
		if (checkboxes[i].checked) {
			nbCheckedBoxes++;
		} else {
			flag3++;
		}
	}

	// document.getElementsByClassName("div1")[0].innerHTML = "nb of boxes: " + nbOfBoxes;
	// document.getElementsByClassName("div2")[0].innerHTML = "nb of checked boxes: " + nbCheckedBoxes;

	if (
		nbCheckedBoxes == nbOfBoxes - numberOfLinkedCourses ||
		nbCheckedBoxes == nbOfBoxes
	) {
		for (var i = 0; i < checkboxes.length; i++) {
			if (checkboxes[i].checked) {
				checkboxes[i].disabled = true;
			} else {
				if (flag) flag--;
				if (
					totalCredits + parseInt(checkboxes[i].getAttribute("data-credits")) <=
					36
				)
					checkboxes[i].disabled = false;
				if (checkboxes[i].checked) flag++;
			}
		}
	}
}

// Function to check if the course has the same name as one of the failed courses
function hasSameNameAsFailedCourse(checkbox, failedCourses) {
	var courseName = getCourseName(checkbox).slice(0, -2);
	var isFailed = failedCourses.some(function (failedCourse) {
		return failedCourse.startsWith(courseName);
	});
	return isFailed;
}

// Function to get the course name from the checkbox
function getCourseName(checkbox) {
	return checkbox.getAttribute("value");
}
// document.getElementsByClassName("div3")[0].innerHTML = "nb of linked boxes: " + numberOfLinkedCourses;
// });

// function enableDisabledCheckboxes() {
// 	var checkboxes = document.querySelectorAll('.nerdstuff[disabled]:checked');
// 	checkboxes.forEach(function (checkbox) {
// 		checkbox.disabled = false;
// 	});
// }

// // Add an event listener to the form to call the enableDisabledCheckboxes function before submission
// document.addEventListener('DOMContentLoaded', function () {
// 	var form = document.querySelector('form');
// 	form.addEventListener('submit', enableDisabledCheckboxes);
});
