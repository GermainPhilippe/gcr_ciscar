//fckplugin.js
/*
* your plugin must be put in the 'editor/plugins/#plug-in name#' (the name is specified in fckconfig.js -> addPlugin, see below)
* in my case this is 'editor/plugins/insertvariables/'
*
* insert variable editor
* @author: Tim Struyf, Roots Software (http://www.roots.be), tim.struyf@roots.be
*/
var InsertVariableCommand=function(){
//create our own command, we dont want to use the FCKDialogCommand because it uses the default fck layout and not our own
};
InsertVariableCommand.GetState=function() {
return FCK_TRISTATE_OFF; //we dont want the button to be toggled
}
InsertVariableCommand.Execute=function() {
//open a popup window when the button is clicked
window.open('DocInfoDynList.php', 'insertvariables', 'width=500,height=400,scrollbars=no,scrolling=no,location=no,toolbar=no');
}
FCKCommands.RegisterCommand('insertvariables', InsertVariableCommand ); //otherwise our command will not be found
var oInsertVariables = new FCKToolbarButton('insertvariables', 'insert variable');
oInsertVariables.IconPath = FCKConfig.PluginsPath + 'insertvariables/insertvariables.gif'; //specifies the image used in the toolbar
FCKToolbarItems.RegisterItem( 'Insert_Variables', oInsertVariables );