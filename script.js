// Homework 2: Javascript & jQuery //
// Please complete the following problems. Remember, you are not allowed to change the index.php file. Only this js file.

// Event listeners are pretty much what they sounds like: they listen and react to events. Sometimes called Event Handlers

// Problem 1 jQuery Event Listeners
// Add one event listener that responds to a click of any of the "Free Movie Download" buttons and pops up an alert message to users. Make up your own text for the alert message! Be creative! Surprise us!

// just need to add alter, one thing need to notice is choose button based on three class
$(".alert.download.btn").click(function(){
    alert("No way to download free ^_^ ^_^ ^_^");
});


// Problem 2 jQuery CSS
// Even though best practices suggest that you change classes  and style the classes in a separate css file rather than change CSS directly, occasionally it is necessary to edit CSS directly using JavaScript.
// Find the "Border" button on the Control Panel on the page. Add an event handler so that when it is clicked each movie is styled to have a 3px solid yellow border.

// use css function to set the moives class css propertiy
$("#border").click(function(){
	$(".movies").css("border","3px solid yellow");
})





// Problem 3 - jQuery Toggle
// Attach an event handler / listener to the 'Toggle' button on the control panel that changes whether the descriptive text (Title, release date, running time) are visible.
var hide = false;
$("#toggle").click(function(){
	// when this button is clicked
	// if description is visible, change it to invisible and vise verse
	if (!hide) {
		$("ul").hide();
		hide = true;
	}else{
		$("ul").show();
		hide = false;
	}
	
})



// Problem 4 - Loading new text
// At the bottom of the page, you'll find a "Favorite Quotes" section. Your function should add quotes there.
// On the file system, you'll find a folder called 'partials' that contains partial html files. Use the jQuery load() function to load a random quote when the "Load Quote" button is clicked.
//Each new quote should replace the old one, not an increasingly long list of quotes.
//You'll need to figure out how to make it random
//Hint: look at Math.random and Math.floor

$("#quotes").click(function(){
	// random a number in range [0...4] and get the html file name based on this number
	// clear the childern of class="quotes" and then load new file to here
	var ran = Math.floor(Math.random() * 5);
	var fileName = "partials/quotes_partial"+ran+".html";
	var node = $(".quotes");
	if (node[0].hasChildNodes()) {
		node[0].removeChild(node[0].childNodes[0]);
	};

	// var childs = $(".quotes").childNodes;
	// $(".quotes").removeChild(childs[0]);
	node.load(fileName);
})



// Problem 5a - Helper Functions
/* For this problem, you will be writing two helper functions that will help you with the next problem. 
* The first is a function to return the running time
* If you could change index.php you might naturally put the running time in a <span> of its own 
* with a class that would allow you to easily reference it. But you can't do that so you have to work harder to 
* get the running time.
* Inside #movies-container, the elements are indexed 0 - 5 with one for each of the six movies 
* Write a function that accepts the movie index (0 for episode 1, 1 for episode 2 etc)
* as a parameter and returns the running time
*/

// $("#convert").click(function(){
// 	var i = 3;
// 	var movies = $(".movies");
// 	var movie = movies[i];
// 	var description = movie.getElementsByTagName("li")[2].textContent ;
// 	// alert(description);
// 	var time = description.replace(/\D+/g, '');
// 	alert(time);
// });

function runningTime(i){
	// get the movie according to index and then get the running time description by tag
	// eliminate all non-number digits with '' to get the number which is time
	var movies = $(".movies");
	var movie = movies[i];
	var description = movie.getElementsByTagName("li")[2].textContent ;
	// alert(description);
	var elements = description.split(" ");
	var times = [];
	for (var i = 0; i < elements.length; i++) {
		// add it to array if its a number
		if (!isNaN(elements[i])) {
			times.push(parseInt(elements[i]));
		};
	}
	return times;
};

// Verify that this function works. Open your browser's console and type in the following:
	// runningTime(1);
// you should get the following result:
	// 142

//Problem 5b
//Write another function that takes a movie index and a string 
//as parameters. It should replace the line containing the movie's 
//current running time with the contents of the string.

function rewrite(i, string){
	var movies = $(".movies");
	var movie = movies[i];
	string = string.replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
	movie.getElementsByTagName("li")[2].textContent = string;
}

// Verify that this function works. Type the following into your console:
//     rewrite(0,"Running Time: 400 minutes");
// You should see that the line: "Running Time: 133 minutes" under the first movie is replaced with "Running Time: 400 minutes"

//Problem 5c
// Test your rewrite function! Use values from the "Test Rewrite" pick list
// and text input to run your function when the user clicks the "Test" button
// If the user forgot to select a movie, give them a reminder instead of 
// running the function

$("#test_rewrite").click(function(){
	var e = document.getElementById("rewrite_select");
	var value = e.options[e.selectedIndex].value;
	// we judge whether user has selected one by judge whether the dom.value is number or not 
	// and whether its in the range [0...5],there could be other ways to test, I think this one might be better
	var reg = /^\d{1}$/;
	if (!reg.test(value)) {
		alert("Please select one movie that you want to rewrite");
	}else{
		var index = parseInt(value);
		if(index > 5 || index < 0){
			alert("This movie dosen't exist");
		}else{
			var textDom = document.getElementById("rewrite_text");
			var str = textDom.value;
			rewrite(index, str);
			// console.log(str);
		}

	}
})



// Problem 6 - Apply Helper Functions
// Use your helper functions to convert the running time format of all the movies from minutes to ___ hours ___minutes.
// Hint: Be sure to check the running time format so your function 
// responds appropriately if the time has already been converted. 
$( "#convert" ).on("click", function() {
	// replace below code
	for (var i = 0; i <= 5; i++) {
		var times = runningTime(i)
		if (times.length == 1) {
			// only one element, so this is __ minutes format
			var hour = Math.floor(times[0] / 60);
			var minute = times[0] % 60;
			rewrite(i, "Running Time: " + hour +" hour " + minute + " minutes");
		}else{
			var hour = times[0];
			var minute = times[1];
			var totalTime = hour * 60 + minute;
			rewrite(i, "Running Time: " + totalTime + " minutes");
		}
	};
	// if( true ) {







	// }
	// // OPTIONAL BONUS CHALLENGE - add an "else" statement to the 
	// // that converts from hours and mintues back to minutes
	// // Note: Maximum score on the assigmnent is 100.
	// // else { 






	// //}
});

// Problem 7 - Adding Class
// So far we've learned we can bind events to classes and style them with CSS, but now let's do some logic with classes.
// Write a function that can add a class 'old' to the movie posters of movies released before the year 2000 and bind it to
// the addClass button.


function getYear(i){
	var movies = $(".movies");
	var movie = movies[i];
	var description = movie.getElementsByTagName("li")[1].textContent;
	var elements = description.split(" ");
	return parseInt(elements[elements.length - 1]);
}

$("#addClass").click(function(){
	var movies = $(".movies");
	for (var i = 0; i < movies.length; i++) {
		var year = getYear(i);
		if (year < 2000) {
			movies[i].className += " old";
		};
	}
});


// Problem 8 - Implement ReplaceAll
// The search functionality is implemented already below for all of the movie details. 
$("#search").bind('keyup', function(){
	// for each of the paragraphs in main text
	$("ul").children().each(function(){
		//retrieve the current HTML
		var currentString = $(this).html();
		console.log(currentString);
		//Remove existing highlights
		currentString = replaceAll(currentString, '<span class="matched">',"");
		currentString = replaceAll(currentString, "</span>","");
		// add in new highlights
		currentString = replaceAll(currentString, $("#search").val(), '<span class="matched">$&</span>');
		// replace the current HTML with highlighted HTML
		$(this).html(currentString);
	});
});

/* Replaces all instances of "replace" with "with_this" in the string "txt"
using regular expressions -- SEE BELOW */
function replaceAll(txt, replace, with_this) {
	return txt.replace(new RegExp(replace, 'g'),with_this);
}

  
 // TODO: You must implement the ReplaceAll functionality. 
$("#replace").bind('click', function(){

	$("ul").children().each(function(){
		//retrieve the current HTML
		var currentString = $(this).html();
		// console.log(currentString);
		var oriTe = $("#original").val().replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
		var newTe = $("#newtext").val().replace(/&/g, '&amp;').replace(/</g, '&lt;').replace(/>/g, '&gt;').replace(/"/g, '&quot;');
		// var newTe = $("#newtext").val();
		currentString = replaceAll(currentString, oriTe, newTe);
		$(this).html(currentString);
	});
});

// To recieve bonus points on this assignment, see the description of Problem 6
	//Note: Maximum points for the assignment is 100. Bonus does not make it higher.
	
// Don't forget to read the published assignment which includes uploading your file to CMS.

