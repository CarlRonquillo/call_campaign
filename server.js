var socket  = require( 'socket.io' );
var express = require('express');
var app     = express();
var server  = require('http').createServer(app);
var io      = socket.listen( server );
var port    = process.env.PORT || 3000;

server.listen(port, function () {
  console.log('Server connected at port %d', port);
});


io.on('connection', function (socket) {

  socket.on( 'new_count_record', function( data ) {
    io.sockets.emit( 'new_count_record', { 
    	new_count_record: data.new_count_record
    });
  });

  socket.on( 'update_count_message', function( data ) {
    io.sockets.emit( 'update_count_message', {
    	update_count_message: data.update_count_message 
    });
  });

  socket.on( 'new_record', function( data ) {
    io.sockets.emit( 'new_record', {
    	FirstName: data.FirstName,
      LastName: data.LastName,
      State: data.State,
      PhoneNo: data.PhoneNo,
      Email: data.Email,
      DateOrdered: data.DateOrdered,
      DVD: data.DVD,
      Catalog: data.Catalog,
      Brochure: data.Brochure,
      Envelope: data.Envelope,
      Name: data.Name,
      Completed: data.Completed,
      Closed: data.Closed
    });
  });

  
});
