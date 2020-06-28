const Database = require('better-sqlite3');
const _DB = new Database('./db/brief07.db');
// 
const _CHALK = require('chalk');
const log = console.log;
// 
function createTables() {
    const string = `CREATE TABLE IF NOT EXISTS User(id STRING, nomPrenom STRING,email STRING,pass STRING); 
        CREATE TABLE IF NOT EXISTS Planet(id INTEGER PRIMARY KEY,name STRING,description TEXT,population STRING,polution STRING,price INTEGER,imgName STRING); 
        CREATE TABLE IF NOT EXISTS Reservation(id INTEGER PRIMARY KEY,idUser STRING,idPlanet INTEGER,logement STRING,dateN DATE,dateD DATE,dateF DATE,nbPersones INTEGER,prix DOUBLE,carteB STRING,ccv INTEGER);`;
    // 
    _DB.exec(string);
    log(_CHALK.black.bgCyan.italic("Tables Check done !"));
}
// 
function insertData(table, data) {
    console.log(data);
    var str = 'INSERT INTO User (id,nomPrenom,email,pass) VALUES(@id,@nomPrenom,@email,@pass);';
    switch (table) {
        case "Planet":
            str = 'INSERT INTO Planet (name,description,population,polution,price,imgName) VALUES(@name,@description,@population,@polution,@price,@imgName);';
            break;
        case "Reservation":
            str = 'INSERT INTO Reservation (idUser,idPlanet,logement,dateN,dateD,dateF,nbPersones,prix,carteB,ccv) values(@idUser,@idPlanet,@logement,@dateN,@dateD,@dateF,@nbPersones,@price,@carteB,@ccv);';
            break;
    }
    try {
        var state = _DB.prepare(str).run(data);
        console.log(state);
        return Boolean(state.changes);
    } catch (err) {
        console.log(err);
        log(_CHALK.black.bgRed.italic("Error! [Function insertData()]"));
    }
}
// 
function getReservation(clientId) {
    return _DB.prepare(`SELECT Reservation.*,Planet.name,Planet.imgName FROM Reservation,Planet WHERE Planet.id = Reservation.idPlanet AND Reservation.idUser='${clientId}' `).all();
}
// 
function getUserCred(data) {
    return _DB.prepare(`SELECT id,email,nomprenom,COUNT(id) AS userExists FROM User WHERE email = '${data.email}' AND pass = '${data.pass}'`).get();
}
// 
function getUserData(userId) {
    return _DB.prepare(`SELECT * FROM User WHERE id = '${userId}'`).get();
}
// 
function deleteQuery(table, key) {
    let query = `DELETE FROM ${table} WHERE id='${key}'`;
    let res = _DB.prepare(query).run();
    // 
    return res.changes;
}
// 
function editReservation(data) {
    const query = `UPDATE Reservation SET idPlanet = '${data.idPlanet}',logement = '${data.logement}',dateN='${data.dateN}',dateD='${data.dateD}',dateF = '${data.dateF}',nbPersones='${data.nbPersones}',prix='${data.prix}',carteB='${data.carteB}',ccv='${data.ccv}' WHERE id=${data.id};`;
    let res = _DB.prepare(query).run();
    // 
    return res.changes;
}

function getAllTableData(table) {
    const query = `SELECT * FROM ${table}`;
    let res = _DB.prepare(query).all();
    // 
    return res;
}
// 
function editUserPass(data) {
    const query = `UPDATE User SET pass = '${data.password}' WHERE id='${data.id}';`;
    let res = _DB.prepare(query).run();
    // 
    return Boolean(res.changes);
}
// 
// getReservation("sdq");
// 
module.exports = {
    createTables,
    insertData,
    getReservation,
    getUserCred,
    getUserData,
    deleteQuery,
    editReservation,
    getAllTableData,
    editUserPass
}
// 
// createTables();
/*insertData("ss", {
    id: "qqq",
    nomPrenom: "qdqsd",
    email: "qsdqsdq",
    pass: "qdqsdqs"
});*/