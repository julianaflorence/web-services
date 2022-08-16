<html>
<head>
<title>Julis Favorite Books</title>
<style>
	body {font-family:georgia;}

  
  .film{
    border:1px solid #E77DC2;
    border-radius: 5px;
    padding: 5px;
    margin-bottom:5px;
    position:relative;   
  }
 
  .pic{
    position:absolute;
    right:10px;
    top:10px;
  }

  .pic img{
	  max-width:150px;
  }

  
</style>
<script src="https://code.jquery.com/jquery-latest.js"></script>

<script type="text/javascript">

function bookTemplate(film){

  return `
			  <div class="film">
         <b> Title </b>: ${film.Title}<br />
         <b> Author </b>: ${film.Author} <br />
         <b> Year</b>:   ${film.Year} <br />
         <b> Pages</b>: ${film.Pages}<br />
         <b> Stars</b>: ${film.Stars}<br />
        <div class="pic"><img src="images/${film.Image}" /></div>
        </div>
  `;
} 
  
$(document).ready(function() { 
 
  $('.category').click(function(e){
    e.preventDefault(); //stop default action of the link
    cat = $(this).attr("href");  //get category from URL
  
    var request = $.ajax({
      url: "api.php?cat=" + cat,
      method: "GET",
      dataType: "json"
    });
    request.done(function( data ) {
      console.log(data);

      /*
      //using JSON.stringify we can view the data on the page
      let myData = JSON.stringify(data,null,4);
      myData = "<pre>" + myData + "</p>";
      $('#output').html(myData);
      */

      //use data.title to show the order of films
      $("#filmtitle").html(data.title);

      //clear the previous films
      $("#films").html("");

      //loop through data.films and add to #films div
      $.each(data.films,function(i,item){
          let myFilm = bookTemplate(item);
          $("<div></div>").html(myFilm).appendTo("#films");
      });

    });
    request.fail(function(xhr, status, error ) {
    alert('Error - ' + xhr.status + ': ' + xhr.statusText);
    });
  });
}); 

</script>
</head>
	<body>
	<h1>Julis Favorite Book</h1>
  <p> fillerr !<p>
		<a href="year" class="category">Books By Ranking</a><br />
		<a href="box" class="category">Books By Page Number</a>
		<h3 id="filmtitle"></h3>
		<div id="films">
      <!--
			<div class="film">
        <b>Film</b>: 1<br />
        <b>Tital</b>: Dr. No<br />
        <b>Year</b>: 1962<br />
        <b>Director</b>: Terence Young<br />
        <b>Producers</b>: Harry Saltzman and Albert R. Broccoli<br />
        <b>Writers</b>: Richard Maibaum, Johanna Harwood and Berkely Mather<br />
        <b>Composer</b>: Monty Norman<br />
        <b>Bond</b>: Sean Connery<br />
        <b>Budget</b>: $1,000,000.00<br />
        <b>BoxOffice</b>: $59,567,035.00<br />
        <div class="pic"><img src="thumbnails/dr-no.jpg" /></div>
      </div>
      -->
		</div>
		<div id="output"> </div> 
	</body>
</html>