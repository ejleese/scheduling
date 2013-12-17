<html>

<script src="/scheduling/javascript/jquery-1.10.2.min.js"></script>
<script src="/scheduling/javascript/jquery.cookie.js"></script>

<?php include_once '/appl/fp/lib/phpsetvar.php';

// initial default language selection based on location
if (!isset($_GET['lang']))
{
  if ($PFLOC == "NOG")
		$lang="SP";
  else
		$lang="EN";
}
else
	$lang = $_GET['lang'];

if ($lang=="SP")
	$langnext="EN";
else
	$langnext="SP";

// language has been manually selected
	if ($lang == "SP") 
		$langtext = "English";
	else 
		$langtext = "Espa&#241ol"; //yes that is an escape char in there


$mypage=getenv("REQUEST_URI");
$newurl;

$mypage=unparse_url(parse_url($mypage));
function unparse_url($parsed_url)
{
	$path=$parsed_url['path'];
	$query=$parsed_url['query'];

	$queryParts=explode('&',$query);
	$params=array();
  global $langnext;
	$newurl;
	foreach($queryParts as $param)
	{
		$item=explode('=',$param);
		$params[$item[0]]=$item[1];
		if ($item[0]=="lang") $params[$item[0]]=$langnext;
	}

  $paramlist=http_build_query($params);
  $tmp=array($path,"?",$paramlist);
  $newurl=join("",$tmp);
  return $newurl;
}

/*
echo "<i><a href=\"$mypage\" style=\"float:left; font-family:Verdana; font-size:15px;\">$langtext</a>";
*/

?>

<!-- the below may replace most/all of the above php -->

<script>

var lang;
var nextlang;
var nextlanglong;
var loc;

if ($.cookie('lang_cookie')==null) // cookie doesn't exist
{		//default it to server location's presumed language
	loc="<?php echo $PFLOC ?>";

	if (loc=="NOG")
	{
		lang="SP";
		nextlang="EN";
		nextlanglong="English";
	}
	else 
	{
		lang="EN";
		nextlang="SP";
		nextlanglong="Espa&ntildeol";
	}
} 
else // cookie exists 
	lang=$.cookie('lang_cookie'); //grab current language
		
if (lang=="SP")
{
	nextlang="EN";
	nextlanglong="[to English]";
}
else // english presumed
{
	nextlang="SP";
	nextlanglong="[a Espa&ntildeol]";
}

$.cookie('lang_cookie',lang); // make sure cookie is set either way

var url="<?php echo $mypage; ?>"; //from above PHP code
document.write("<i><a href='"+url+"' style='float:left; font-family:Verdana; font-size:12px;' onclick='toggleLang()';>"+ nextlanglong +"</a></i>");

// cookie is now set either way...act accordingly
//show toggle link
//when pressed, toggle cookie value
	//then refresh page

function toggleLang()
{
	$.cookie('lang_cookie',nextlang); // set cookie to toggled language
}


</script>

</html>
