var urlAuthor = "http://localhost/apicko/api.php?action=get_author";
var urlAuthorSongs = "http://localhost/apicko/api.php?action=get_author_songs&author=";
var urlSongInfo = "http://localhost/apicko/api.php?action=get_song_info&song=";
var urlAllSongs = "http://localhost/apicko/api.php?action=get_all_songs";
var urlAlbum = "http://localhost/apicko/api.php?action=get_album";
var urlAlbumSongs = "http://localhost/apicko/api.php?action=get_album_songs&album=";
var urlAuthorAlbums = "http://localhost/apicko/api.php?action=get_author_albums&author=";
var tmpUrlAuthor = "";
var tmpUrlAuthorSongs = "";
var tmpUrlSongInfo = "";
var tmpUrlAllSongs = "";
var tmpUrlAlbum = "";
var tmpUrlAlbumSongs = "";
var tmpUrlAuthorAlbums = "";

var playtime = "default";
var currentSong = "";
var currentAuthor = "";
var currentImg = "";

$(document).ready(function(){
  $( ".footer" ).hide();
  displayFunction();
  $( "#takeMeBack" ).click(function(){
    takeMeBack();
  });
});

function displayAuthor()
{
  $( "#h3author" ).click(function(){
    $( "#display" ).empty();
    $( "#display" ).append('<div class="displayAuthor row">');
    $.getJSON(urlAuthor,function(json){
      $.each(json, function(i, item){
        $( ".displayAuthor" ).append('<div class="col-md"> <span  class="authorClass" id="' + json[i].name + '">' + json[i].real_name + '</span> </div>');
      });
      $( ".authorClass" ).click(function(){
        tmpUrlAuthorSongs += $(this).attr( "id" );
        tmpUrlAuthorAlbums += $(this).attr( "id" );
        displayAuthorSongsAndAlbums();
      });
    });
  });
}

function displayAuthorSongsAndAlbums(){
  $( "#display" ).empty();
  $( "#display" ).append('<div class="displayAuthorSongsAndAlbums row">');
  $( ".displayAuthorSongsAndAlbums" ).append('<div class="col-md-6 albumRowClass">');
  $( ".displayAuthorSongsAndAlbums" ).append('<div class="col-md-6 songRowClass">');
  $( ".albumRowClass" ).append('<h3> Albumy </h3> ');
  $( ".songRowClass" ).append('<h3> Písničky </h3> ');

  $.getJSON(urlAuthorAlbums + tmpUrlAuthorAlbums,function(json){
    tmpUrlAuthorAlbums = "";
    $.each(json, function(i, item){
      $( ".albumRowClass" ).append('<span class="albumClass" id="' + json[i].name + '">' + json[i].real_name + '</span>');
      $( ".albumRowClass" ).append( "<br>" );
    });
    $( ".albumClass" ).click(function(){
      tmpUrlAlbumSongs += $(this).attr( "id" );
      displayAlbumSongs();
    });
  });

  $.getJSON(urlAuthorSongs + tmpUrlAuthorSongs,function(json){
    tmpUrlAuthorSongs = "";
    $.each(json, function(i, item){
      $( ".songRowClass" ).append('<span class="authorSongClass" id="' + json[i].name + '">' + json[i].real_name + '</span>');
      $( ".songRowClass" ).append( "<br>" );
    });
    $( ".authorSongClass").click(function(){
      tmpUrlSongInfo += $(this).attr( "id" );
      displaySong();
    });
  });
}

function displaySong()
{
  $( "#display" ).empty();
  $( "#display" ).append('<div class="setCenter">');
  $( ".setCenter" ).append('<img src="../apicko/img/photo.png" class="imgClass"> <br>');

  $.getJSON(urlSongInfo + tmpUrlSongInfo,function(json){
    $.each(json, function(i, item){
      tmpUrlSongInfo = "";
      playtime = "";
      playtime = json[i].name + '.mp3';
      currentSong = json[i].real_name;
      currentAuthor = json[i].real_author;
      $( ".setCenter" ).append('<span class="songClassic" id="' + json[i].name + '">' +
      json[i].real_name + '<br>' +  json[i].real_author + '</span>');
    });
    displayFooter();
    $( ".songClassic" ).click(function(){
      playSong(playtime);
    });
  });
}

function displayAlbum()
{
  $( "#h3album" ).click(function(){
    $( "#display" ).empty();
    $( "#display" ).append('<div class="displayAlbum row">');
    $.getJSON(urlAlbum,function(json){
      $.each(json, function(i, item){
        $( ".displayAlbum" ).append('<div class="col-md"><span  class="albumClass" id="' + json[i].name + '">' +
        json[i].real_name + '</span> <br> by <span  class="authorClass" >' + json[i].real_author + '</span> </div>');
      });
      $( ".authorClass" ).click(function(){
        tmpUrlAuthorSongs += $(this).attr( "id" );
        tmpUrlAuthorAlbums += $(this).attr( "id" );
        displayAuthorSongsAndAlbums();
      });
      $( ".albumClass" ).click(function(){
        tmpUrlAlbumSongs += $(this).attr( "id" );
        displayAlbumSongs();
      });
    });
  });
}

function displayAlbumSongs()
{
  $( "#display" ).empty();
  $.getJSON(urlAlbumSongs + tmpUrlAlbumSongs,function(json){
    tmpUrlAlbumSongs = "";
    $.each(json, function(i, item){
      $("#display").append('<span class="songClass" id="' + json[i].name + '">' + json[i].real_name + '</span>' + '<br>');
    });

    $( ".songClass" ).click(function(){
      tmpUrlSongInfo = $(this).attr( "id" );
      displaySong();
    });

  });
}

function displaySongs()
{
  $( "#h3song" ).click(function(){
    $( "#display" ).empty();
    $( "#display" ).append('<div class="displaySongs row">');
    $.getJSON(urlAllSongs,function(json){
      $.each(json,function(i, item){
        $( ".displaySongs" ).append('<div class="col-md"><span class="songClass" id="'+ json[i].name + '">' + json[i].real_name + '</span> </div>')
      });
      $( ".songClass" ).click(function(){
        tmpUrlSongInfo = $(this).attr( "id" );
        displaySong();
      });
    });
  });
}

function takeMeBack()
{
  $( "#display" ).empty();
  $( "#display" ).append('<div class="displayMenu row">');
  $( ".displayMenu" ).append('<div class="col-md first">');
  $( ".first" ).append('<span id="h3author"> Interpreti </span>');
  $( ".displayMenu" ).append('<div class="col-md second">');
  $( ".second" ).append('<span id="h3album"> Alba </span>');
  $( ".displayMenu" ).append('<div class="col-md third">');
  $( ".third" ).append('<span id="h3song"> Písničky </span>');

  displayFunction();
}
function displayFooter(){
  $( ".songClassic" ).click(function(){
    $( ".footer" ).fadeIn(3000);
    $( ".songName" ).text(currentSong);
    $( ".songAuthor" ).text('by ' + currentAuthor);
  });
}

function playSong(playtime)
{

  var sound = new Howl({
    src: ['../apicko/music/' + playtime],
    volume: 0.05,
    onplay: function(){
      playBtn.style.display = 'block';
      pauseBtn.style.display = 'none';
    },
    onpause: function(){
      playBtn.style.display = 'none';
      pauseBtn.style.display = 'block';
    }
  });

  if(!sound.playing())
  {
    sound.play();
    var intervalSound = setInterval(function(){ timerSound() }, 1000);

    function timerSound() {
      if(parseFloat(Math.round( sound.seek() * 10 ) / 10).toFixed(0)>1)
      {
        $( '#sec' ).empty();
        $( '#sec' ).append(parseFloat(Math.round( sound.seek() * 10 ) / 10).toFixed(0));
      }
    }
    timerSound();
  }
  $( ".fa-pause" ).click(function(){
    sound.pause();
  $( ".fa-play" ).click(function(){
      if(!sound.playing())
      {
          sound.play();
      }
    });
  });
}

function displayFunction()
{
  displayAuthor();
  displayAlbum();
  displaySongs();
}
