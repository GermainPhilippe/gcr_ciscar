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
        window.open('../../../../modules/document/DocStatic/?action=pg', 'DocStatic', 'width=800,height=600,scrollbars=yes,scrolling=yes,location=no,toolbar=no');
}

// Register the command.
FCKCommands.RegisterCommand('DocStatic', new OpenUrl());

// Add the button.
var item = new FCKToolbarButton('DocStatic', 'Lien Doc Static');
item.IconPath = FCKPlugins.Items['DocStatic'].Path + 'insertvariables.gif';
FCKToolbarItems.RegisterItem('DocStatic', item);