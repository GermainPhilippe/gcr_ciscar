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
       window.open('../../../../modules/app-site-emploi/?action=infospg', 'SiteEmploi', 'width=800,height=600,scrollbars=yes,scrolling=yes,location=no,toolbar=no');
}

// Register the command.
FCKCommands.RegisterCommand('SiteEmploi', new OpenUrl());

// Add the button.
var item = new FCKToolbarButton('SiteEmploi', 'Lien Page Info Site Emploi');
item.IconPath = FCKPlugins.Items['SiteEmploi'].Path + 'insertvariables.gif';
FCKToolbarItems.RegisterItem('SiteEmploi', item);