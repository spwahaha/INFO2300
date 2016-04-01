// Use this Variable keep track of an ajax request as a global variable so 
// it can be aborted
var request;

$(document).ready(function(){

  // google maps code
  function initMap(latlng) {
    
    var splits = latlng.split(",");  
    var myLatLng = {lat: parseFloat(splits[0]), lng: parseFloat(splits[1])};

    var map = new google.maps.Map(document.getElementById('googleMap'), {
		// TODO: center your map on the provided coordinates and set a 
		//       reasonable zoom level
    zoom: 4,
    center: myLatLng
		// HINT: USE https://developers.google.com/maps/documentation/javascript/
    });

    var marker = new google.maps.Marker({
		// TODO: set a Marker on a specified map at a position.
		// HINT: USE https://developers.google.com/maps/documentation/javascript/
		position: myLatLng,
    map: map,
    title: 'Click to zoom'
    });


  }
	 
  // the story starts off at index 0 (in the database)
  var init = {labelno: 0};
  updateStory(init);
  findAlbum();

  $('.goblet').addClass('hidden');
  $('.button-wrapper').addClass('hidden');

  
	// TODO: Create a javascript onclick function that obtains the corresponding 
	//       choice/button.
	//       Then call the updateStory function on that labelno.
  $('.choice1').on("click", function(){
    console.log("choice1 clicked");
    var num = $(this).attr("data-index");
    console.log(num);
      updateStory({labelno:num});
  });


  $('.choice2').on("click", function(){
      console.log("choice1 clicked");
    var num = $(this).attr("data-index");
    console.log(num);   
      updateStory({labelno:num});
  });



	// HINT: there's this cool data-index thing we use to encapsulate
	//       data that is not visible to the user.


  // this has been implemented for you :)
  $('.js-music').on("ended", function() {
    // set the ticker to the beginning of the song
    this.currentTime = 0;
    // load in new music
    findAlbum();
    // pause the music
    this.pause();
    // start loading the music
    this.load();
    // makes sure the music is done loaded before it plays
    this.oncanplaythrough = this.play();
  });


  // HINT: Create an AJAX request that returns the row of the database that  
  //       corresponds to the information for one labelNo.
  // HINT: input to this function should be json formatted like {labelno: 0}
  function updateStory(jsondata) {

    $(".goblet-msg").text('');
    $(".goblet-msg-valid").text('');
    
    console.log(jsondata);

    request = $.ajax({
      // TODO: send the request to your server file. 
	  //Fill in the missing pieces of this AJAX request
      url: "ajax/ajax.php",
      data: jsondata,
      dataType: 'text',
      error: function(error) {
          console.log(error);
      }
    });

    request.success(function(data) {
    console.log("data");
    console.log(data);
		data = JSON.parse(data);

		// TODO: Update the HTML DOM to the text of the json you returned.
		//       The one below has been done for you.
        // HINT: console.log(data);
		$(".story-line").text(data.storyline);
	  $(".choice1").val(data.choice1);
    $(".choice2").val(data.choice2);
    $(".choice1-plot").text(data.choice1_plot);
    $(".choice2-plot").text(data.choice2_plot);	  
    $(".location-label").text(data.location_label);
     document.getElementsByClassName("choice1")[0].setAttribute("data-index", data.choice1result);
	   document.getElementsByClassName("choice2")[0].setAttribute("data-index", data.choice2result);

      initMap(data.location);

      // Set up the goblet for certain story elements
      if (jsondata.labelno == 6) {
        $(".goblet").removeClass('hidden');
        $(".choice1").addClass('goblet-submit');
        $(".goblet-submit").attr("disabled", "disabled");
        $(".choice1").removeClass('goblet-choose');
      } else {
        $(".goblet").addClass('hidden');
      }

      if (jsondata.labelno == 7) {
        $(".button-wrapper").removeClass('hidden');
        $(".choice1").addClass('goblet-choose');
        $(".choice1").removeClass('goblet-submit');
        $(".goblet-choose").removeAttr("disabled");

      } else {
        $(".button-wrapper").addClass('hidden');
      }

    });  
  }

  // HINT: USE https://developer.spotify.com/web-api/endpoint-reference/ 
  //       to find the right endpoint call that 
  //       you will be using AJAX to send a request to.

	
  // TODO: Find spotify's unique albumId for this album and return the Spotify preview track JSON URL
  function findAlbum() {
  	var albumName = "Harry+Potter+and+The+Sorcerer%27s+Stone+Original+Motion+Picture+Soundtrack%22%3B";
    var jsondata={};
    var apiUrl = "https://api.spotify.com/v1/search?" + "q=" + albumName + "&type=album";
    console.log(apiUrl);
  	$.ajax({
      // TODO: complete ajax call
      url:apiUrl,
      // dataType:'text',
      // url: "ajax/ajax.php",
      // data: jsondata,
      dataType: 'text',

      success: function(data) {
        console.log("spotify");
        console.log(data);
        // TODO: Using the Spotify api, return the AlbumId that corresponds 
        //       with the provided albumName.
        data = JSON.parse(data);
        
        var Albumid = data.albums.items[0].href;
        console.log(Albumid);
        playMusic(Albumid);

      }
	  
    });
  }
  
  
  function playMusic(albumID) {
    
    // TODO: populate ajax's url field with the appropriate API endpoint
    // an endpoint is fancy-speak for a url you can send ajax requests to.
	
    $.ajax({
      // TODO: complete ajax call
      url: albumID,
      dataType: 'text',

      // TODO: if you did this correctly, the album info should be stored in data.
      success: function(data) {
        // HINT: use console.log(data) to see the structure.
        console.log(data);
        data = JSON.parse(data);
        var items = data.tracks.items;

        // TODO: using javascript's Math.round() and Math.random(), 
        //       get a random song from the album, assignt to rand
        var rand = Math.floor((Math.random() * items.length) + 1); 
        var chosen = items[rand];
        var preview_url = chosen.preview_url;
        
        // TODO: once you have a track, get its preview_url field and 
        //       change the music player (.js-music) such it plays the new song.
        // HINT: https://developer.mozilla.org/en-US/docs/Web/Guide/HTML/Using_HTML5_audio_and_video
        document.getElementsByClassName("js-music")[0].setAttribute("src", preview_url);
      }

    });

  }

});