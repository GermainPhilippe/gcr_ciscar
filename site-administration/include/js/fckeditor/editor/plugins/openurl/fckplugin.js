// Our method which is called during initialization of the toolbar.
function OpenUrl()
{
}

// Disable button toggling.
OpenUrl.prototype.GetState = function()
{
        return FCK_TRISTATE_OFF;
}

// Our method which is called on button click.
OpenUrl.prototype.Execute = function()
{
        window.open('../../../../modules/document/DocInfoDyn/PGDocInfoDyn.php?add=', 'openurl', 'width=800,height=600,scrollbars=yes,scrolling=yes,location=no,toolbar=no');
}

// Register the command.
FCKCommands.RegisterCommand('openurl', new OpenUrl());

// Add the button.
var item = new FCKToolbarButton('openurl', 'Lien Doc WCM');
item.IconPath = FCKPlugins.Items['openurl'].Path + 'insertvariables.gif';
FCKToolbarItems.RegisterItem('openurl', item);