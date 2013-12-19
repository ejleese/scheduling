<html>

<script src="/scheduling/javascript/jquery-1.10.2.min.js"></script>
<script src="/scheduling/javascript/jquery.cookie.js"></script>

<?php include_once '/appl/fp/lib/phpsetvar.php';
$mypage=getenv("REQUEST_URI");
?>

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
	lang="EN"; // not necessary?
	nextlang="SP";
	nextlanglong="[a Espa&ntildeol]";
}

$.cookie('lang_cookie',lang,{path:'/'}); // make sure cookie is set either way, across whole path since app spans some folders (cgi, scheduling)

var url="<?php echo $mypage; ?>"; //from above PHP code
document.write("<i><a href='"+url+"' style='float:left; font-family:Verdana; font-size:12px;' onclick='toggleLang()'>"+ nextlanglong +"</a></i>");

function toggleLang()
{
//  $.removeCookie('lang_cookie'); // because IE isn't resetting value properly
	$.cookie('lang_cookie',nextlang,{path:'/'}); // set cookie to toggled language
}

</script>
</html>
