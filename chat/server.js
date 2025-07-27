//var mysql = require('mysql');
var client = require('socket.io').listen(3000).sockets;

var users = {};
var sockets = {};

client.on('connection', function(socket) {

    // Register your client with the server, providing your username
    socket.on('init', function(username,id) {
        //users[username] = socket.id;    // Store a reference to your socket ID
        users[username] = socket.id;    // Store a reference to your socket ID
        sockets[socket.id] = { id : id, username : username, socket : socket };  // Store a reference to your socket
        //console.log(sockets[users[username]].socket.id);
        console.log('user count : ' + Object.keys(users).length);
    });

    // Private message is sent from client with username of person you want to 'private message'
    socket.on('send', function(message) {
        // Lookup the socket of the user you want to private message, and send them your message
        console.log('message received to : ' + message.to);
        sockets[users[message.to]].socket.emit(
            'message', 
            { 
                message : message.msg, 
                from : sockets[socket.id].username,
                id : sockets[socket.id].id 
            }
        );
    });

    /* client disconnected */	
	socket.on('disconnect', function() {
		try {
			RemoveUser(socket);			
		}catch(e){			
		}
	 });
});

/* remove user stored info from array */
function RemoveUser(sockclient)
{
	delete users[sockets[sockclient.id].username];
	delete sockets[sockclient.id];	
}