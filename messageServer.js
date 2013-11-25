var socket = require( 'socket.io' );
var express = require( 'express' );
var http = require( 'http' );
var mcrypt = require('mcrypt');
var JSON2 = require( 'JSON2' );

var app = express();
var server = http.createServer( app );

var io = socket.listen( server );

var clients = {};

io.sockets.on( 'connection', function( client ) {
    console.log( "New client !" );
    
    client.on( 'register', function( data ) {
        var bfEcb = new mcrypt.MCrypt('rijndael-128', 'ecb');
        bfEcb.open('M02cnQ51Ji97vwT4');
        
        var ciphertext = new Buffer(data.data, 'base64');
        var plaintext = bfEcb.decrypt(ciphertext);
        
        var userObject = JSON.parse(plaintext.toString().replace(/\x00+$/g, ''));

        clients[userObject.User.username] = client.id;
        console.log ("registered client: " + userObject.User.username + " : " + client.id);
    });
    
    client.on( 'message', function( data ) {
        var bfEcb = new mcrypt.MCrypt('rijndael-128', 'ecb');
        bfEcb.open('M02cnQ51Ji97vwT4');
        
        var ciphertext = new Buffer(data.message, 'base64');
        var plaintext = bfEcb.decrypt(ciphertext);
        
        var messageObject = JSON.parse(plaintext.toString().replace(/\x00+$/g, ''));
        
        if (messageObject.to !== undefined) {
            var to = clients[messageObject.to];
            io.sockets.socket(to).emit( 'privatemessage', { username: messageObject.username, message: messageObject.message, to: messageObject.to } );
        } else {
            io.sockets.emit( 'message', { username: messageObject.username, message: messageObject.message } );
        }
        
    });
    
    client.on('disconnect', function () {
        console.log('disconnection');
        for (var key in clients) {
            var value = clients[key];
            console.log(value);
            console.log(client.id);
            if (value == client.id) {
                delete clients[key];
                console.log("removing client: " + key + " : " + client.id);
                break;
            }
        }
        
    });
});



server.listen( 8080 );