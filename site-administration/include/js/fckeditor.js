

var urlobj = 'ImagesURL';

function OpenServerBrowser( url, width, height )
{
	urlobj = 'ImagesURL';
	ServerBrowser( url, width, height );
}



function OpenServerBrowser2( url, width, height )
{
	urlobj = 'ImagesURL2';
	ServerBrowser( url, width, height );
}

function OpenServerBrowser3( url, width, height )
{
	urlobj = 'ImagesURL3';
	ServerBrowser( url, width, height );
}

function OpenServerBrowser4( url, width, height )
{
	urlobj = 'ImagesURL4';
	ServerBrowser( url, width, height );
}

function OpenServerBrowser5( url, width, height )
{
	urlobj = 'ImagesURL5';
	ServerBrowser( url, width, height );
}


function ServerBrowser( url, width, height )
{
	var iLeft = (screen.width  - width) / 2 ;
	var iTop  = (screen.height - height) / 2 ;

	var sOptions = "toolbar=no,status=no,resizable=yes,dependent=yes" ;
	sOptions += ",width=" + width ;
	sOptions += ",height=" + height ;
	sOptions += ",left=" + iLeft ;
	sOptions += ",top=" + iTop ;

	var oWindow = window.open( url, "BrowseWindow", sOptions ) ;
}


function SetUrl( url, width, height, alt )
{
	document.getElementById(urlobj).value = decodeURIComponent(url) ;
	oWindow = null;
}
