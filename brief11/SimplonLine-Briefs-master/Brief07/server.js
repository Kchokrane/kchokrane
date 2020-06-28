const _EXPRESS = require('express');
// const _SESSION = require('express-session');
const _APP = _EXPRESS();
const _BODY_PARSER = require('body-parser')
const _PATH = require('path');
const _PORT = 8080;
// 
const DB = require('./model/sqlite');
DB.createTables();
// 
// 
_APP.use(_BODY_PARSER.json());
_APP.use(_BODY_PARSER.urlencoded({
    extended: true
}));
_APP.use('/app', _EXPRESS.static(_PATH.join(__dirname, 'app')));
// 
_APP.get('/', (req, res) => {
    res.sendFile(_PATH.join(__dirname, 'index.html'));
});
// 
// 
_APP.post('/save', (req, res) => {
    console.log(req.body.data);
    var ret = DB.insertData(req.body.type, req.body.data);
    res.end(ret.toString());
});
_APP.post('/getUserData', (req, res) => {
    var ret = DB.getUserData(req.body.userId);
    res.end(JSON.stringify(ret));
});
_APP.post('/getReservations', (req, res) => {
    var ret = DB.getReservation(req.body.clientId);
    res.end(JSON.stringify(ret));
});
_APP.post('/login', (req, res) => {
    var ret = DB.getUserCred(req.body.data);
    res.end(JSON.stringify(ret));
});
_APP.post('/remove', (req, res) => {
    var ret = DB.deleteQuery(req.body.table, req.body.key);
    res.end(ret.toString());
});
_APP.post('/editReservations', (req, res) => {
    var ret = DB.editReservation(req.body.data);
    res.end(ret.toString());
});
_APP.post('/getAll', (req, res) => {
    var ret = DB.getAllTableData(req.body.table);
    res.end(JSON.stringify(ret));
});
_APP.post('/updatePass', (req, res) => {
    var ret = DB.editUserPass(req.body.data);
    res.end(ret.toString());
});
// START THE SERVER
_APP.listen(_PORT, () => {
    console.log(`Listening on port ${_PORT}\nPlease refere to : localhost:${_PORT}`);
});