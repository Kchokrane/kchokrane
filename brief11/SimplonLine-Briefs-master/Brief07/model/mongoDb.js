// const uri = "mongodb+srv://3li:136246180nioce@brief-07-vcowh.mongodb.net/yy?retryWrites=true&w=majority";
// const mongoose = require('mongoose');
/*async function test() {
    // await mongoose.connect(uri, {
    //     useNewUrlParser: true,
    //     useUnifiedTopology: true
    // });
    // console.log("Connected to DB");
    // 
    const Schema = mongoose.Schema;
    const Comment = new Schema();

    Comment.add({
        title: {
            type: String,
            index: true
        },
        body: String
    });

    const MyModel = mongoose.model('model1', Comment);

    const model = new MyModel({
        title: "qdqsdqss",
        body: "sssssssssssssssss"
    });
    // 
    model.save();
    // 
    console.log(model);
}
// 
// 

// 
test();*/







// 
// 
// 
const mongoose = require('mongoose');
const _PATH = require('path');
require("dotenv").config({
    path: _PATH.join(__dirname, 'config', '.env')
});
// 
const _CHALK = require('chalk');
const log = console.log;
// 
const _MONGODB_DATA = {
    user: "3li",
    pass: "136246180nioce",
    db: "db_Brief07"
}
const _URI = `mongodb+srv://${_MONGODB_DATA.user}:${_MONGODB_DATA.pass}@brief-07-vcowh.mongodb.net/${_MONGODB_DATA.db}?retryWrites=true&w=majority`;
// 
// 
async function connectionStart() {
    await mongoose.connect(_URI, {
        useNewUrlParser: true,
        useUnifiedTopology: true
    });
    if (mongoose.connection.readyState == 1)
        log(_CHALK.white(
            'Connexion avec la base de données établie avec ' +
            _CHALK.black.bgGreen.bold('succès')
        ));
    // 
}
async function connectionStop() {
    if (mongoose.connection.readyState == 1) {
        mongoose.disconnect();
        log(_CHALK.white(
            'La connexion avec la base de données est ' +
            _CHALK.white.bgRed.bold('fermée')
        ));
    }
}
// 
function createTable(name) {
    const schema = new mongoose.Schema();
    let data = {};
    switch (name) {
        case "user":
            data = {
                id: String,
                nomPrenom: String,
                email: String,
                pass: String
            };
            break;
        case "planet":
            data = {
                name: String,
                description: String,
                population: String,
                polution: String,
                price: String
            };
            break;
        case "reservation":
            data = {

            };
            break;
    }
    schema.add(data);
    // 
    return mongoose.model(name, schema);
}
// 
function addToTable(data) {
    const model = createTable("users", data);
    const subModel
}