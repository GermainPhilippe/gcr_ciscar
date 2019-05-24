// Our method which is called during initialization of the toolbar.
function Mediatheque()
{
}

// Disable button toggling.
Mediatheque.prototype.GetState = function()
{
	return FCK_TRISTATE_OFF;
}

// Our method which is called on button click.
Mediatheque.prototype.Execute = function()
{
	window.open('../../../../modules/biblio-media/index_simple.php?action=fckeditor', 'Mediatheque', 'width=800,height=600,scrollbars=yes,scrolling=yes,location=no,toolbar=no');
}

// Register the command.
FCKCommands.RegisterCommand('Mediatheque', new Mediatheque());

// Add the button.
var item = new FCKToolbarButton('Mediatheque', 'Mediatheque');
item.IconPath = FCKPlugins.Items['Mediatheque'].Path + 'icon_attachment.gif';
FCKToolbarItems.RegisterItem('Mediatheque', item);