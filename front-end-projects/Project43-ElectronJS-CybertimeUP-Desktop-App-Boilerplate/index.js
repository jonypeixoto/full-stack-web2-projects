const electron = require('electron');
const url = require('url');
const path = require('path');
const {Menu} = require('electron');

const{
    app, BrowserWindow
} = electron;

let mainWindow;
let addWindow;

app.on('ready',function(){
    mainWindow = new BrowserWindow({});

    mainWindow.loadURL(url.format(
        {
            pathname: path.join(__dirname,'index.html'),
            protocol:'file',
            slashes:true
        }
    ));

    mainWindow.setTitle('CybertimeUP Desktop App');

    const mainMenu = Menu.buildFromTemplate(menuTemplate);
    Menu.setApplicationMenu(mainMenu);

});

const menuTemplate = [

]