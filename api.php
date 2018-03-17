<?php
$conn = mysqli_connect('localhost','root','root','api')  or die(mysql_error());

function get_all_songs()
{
  global $conn;
  $myQuery = "SELECT * FROM songs";
  $result = $conn->query($myQuery);
  $array = mysqli_fetch_all($result,MYSQLI_ASSOC);
  return $array;
}
function whisperer()
{
  if(isset($_GET["term"]))
  {
    global $conn;
    $term = $_GET["term"];

    $myQuery1 = "SELECT real_name AS label, 'album' as product FROM albums WHERE real_name LIKE '%$term%'";

    $myQuery2 =  "SELECT real_name AS label, 'song' as product FROM songs WHERE real_name LIKE '%$term%'";

    $myQuery3 =  "SELECT real_name AS label, 'autor' as product FROM author WHERE real_name LIKE '%$term%'";

    $result1 = mysqli_query($conn,$myQuery1);
    $result2 = mysqli_query($conn,$myQuery2);
    $result3 = mysqli_query($conn,$myQuery3);

    if(mysqli_num_rows($result1) == 0 && mysqli_num_rows($result1) == 0 && mysqli_num_rows($result3) == 0)
    {
      $array = array("id"=>404, "name"=>"Nemohli jsme najít výsledek.");
    }

    if(mysqli_num_rows($result1) != 0)
    {
      $array = mysqli_fetch_all($result1,MYSQLI_ASSOC);
    }

    if(mysqli_num_rows($result2) != 0)
    {
      $array = mysqli_fetch_all($result2,MYSQLI_ASSOC);
    }

    if(mysqli_num_rows($result3) != 0)
    {
      $array = mysqli_fetch_all($result3,MYSQLI_ASSOC);
    }

  }

  return $array;
}

function get_author()
{
  if(isset($_GET["author"]))
  {
    global $conn;
    $author = $_GET["author"];
    $myQuery = "SELECT * FROM author WHERE name = '$author'";

    $result = mysqli_query($conn,$myQuery);

    if(mysqli_num_rows($result) == 0)
    {
      $array = array("id"=>404, "name"=>"Autor neexistuje");
    }
    else
    {
      $array = mysqli_fetch_all($result,MYSQLI_ASSOC);
    }
  }
  else
  {
    global $conn;
    $myQuery = "SELECT * FROM author";
    $result = $conn->query($myQuery);
    $array = mysqli_fetch_all($result,MYSQLI_ASSOC);
  }
  return $array;
}

function get_album()
{
  if(isset($_GET["album"]))
  {
    global $conn;
    $album = $_GET["album"];
    $myQuery = "SELECT * FROM albums WHERE name = '$album'";
    $result = mysqli_query($conn,$myQuery);
    if(mysqli_num_rows($result) == 0)
    {
      $array = array("id"=>404, "name"=>"Autor zatim nic nepridal");
    }
    else
    {
      $array = mysqli_fetch_all($result,MYSQLI_ASSOC);
    }
  }
  else
  {
    global $conn;
    $myQuery = "SELECT * FROM albums";
    $result = $conn->query($myQuery);
    $array = mysqli_fetch_all($result,MYSQLI_ASSOC);
  }
  return $array;
}
function get_author_songs()
{
  if(isset($_GET["author"]))
  {
    global $conn;
    $author = $_GET["author"];
    $myQuery = "SELECT * FROM songs WHERE author = '$author'";
    $result = mysqli_query($conn,$myQuery);
    if(mysqli_num_rows($result) == 0)
    {
      $array = array("id"=>404, "name"=>"Autor zatim nic nepridal");
    }
    else
    {
      $array = mysqli_fetch_all($result,MYSQLI_ASSOC);
    }
    return $array;
  }
}
function get_album_songs()
{
  if(isset($_GET["album"]))
  {
    global $conn;
    $album = $_GET["album"];
    $myQuery = "SELECT * FROM songs WHERE album = '$album'";
    $result = mysqli_query($conn,$myQuery);
    if(mysqli_num_rows($result) == 0)
    {
      $array = array("id"=>404, "name"=>"Autor zatim nic nepridal");
    }
    else
    {
      $array = mysqli_fetch_all($result,MYSQLI_ASSOC);
    }
  }
  return $array;
}
function get_author_albums()
{
  if(isset($_GET["author"]))
  {
    global $conn;
    $author = $_GET["author"];
    $myQuery = "SELECT * FROM albums WHERE author = '$author'";
    $result = mysqli_query($conn,$myQuery);
    if(mysqli_num_rows($result) == 0)
    {
      $array = array("id"=>404, "name"=>"Autor zatim nic nepridal");
    }
    else
    {
      $array = mysqli_fetch_all($result,MYSQLI_ASSOC);
    }
    return $array;
  }
}
function get_song_info()
{
  global $conn;
  $song = $_GET["song"];
  $myQuery ="SELECT * FROM  songs WHERE name = '$song'";
  $result = mysqli_query($conn,$myQuery);
  if(mysqli_num_rows($result) == 0)
  {
    $array = array("id"=>404, "name"=>"Autor zatim nic nepridal");
  }
  else
  {
    $array = mysqli_fetch_all($result,MYSQLI_ASSOC);
  }
  return $array;
}

$url = array("get_all_songs", "get_author", "get_author_songs", "get_song_info", "get_album", "get_album_songs", "get_author_albums", "whisperer");

$value = "default";

if (isset($_GET["action"]) && in_array($_GET["action"], $url))
{
  switch ($_GET["action"])
  {
    case "get_all_songs":
    $value = get_all_songs();
    break;

    case "get_author":
    $value = get_author();
    break;

    case "get_author_songs":
    $value = get_author_songs();
    break;

    case "get_song_info":
    $value = get_song_info();
    break;

    case "get_album":
    $value = get_album();
    break;

    case "get_album_songs":
    $value = get_album_songs();
    break;

    case "get_author_albums":
    $value = get_author_albums();
    break;

    case "whisperer":
    $value = whisperer();
    break;

  }

}

exit(json_encode($value));
