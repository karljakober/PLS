var socket = io.connect( 'http://karljakober.kd.io:8080' );

var body = document.body;

$( "body" ).toggleClass( "cbp-spmenu-push" );
$('.cbp-spmenu').scrollTop($('.cbp-spmenu')[0].scrollHeight);

$( "#showLeftPush" ).click( function() {
    //classie.toggle( this, 'active' );
    $( "body" ).toggleClass( 'cbp-spmenu-push-toright' );
    $( "#cbp-spmenu-s1" ).toggleClass( 'cbp-spmenu-open' );
});

$.ajax({
    url: "/messages/register",
    type: "POST",
    data: {},
    success: function(data) {
        socket.emit( 'register', { data: data } );
    }
});

$( "#messageSubmit" ).click( function() {
    var msg = $( "#messageInput" ).val();
    var command = 'message'; 

    if (msg.substr(0, 1) === '/') {
        firstSpace = msg.indexOf(' ');
        command = msg.substr(1, firstSpace - 1);
        parameters = msg.substr(firstSpace + 1);
        
        if (parameters.indexOf(' ') != '-1') {
            secondSpace = parameters.indexOf(' ');
            target = parameters.substr(0, secondSpace);
            message = parameters.substr(secondSpace + 1);
        } else {
            target = parameters;
        }

        if (~['w', 'whisper', 't', 'tell', 'to'].indexOf(command)) {
            $.ajax({
                url: "/messages/add",
                type: "POST",
                data: { message: message, to: target },
                success: function(data) {
                    socket.emit( 'message', { message: data } );
                }
            });
        } else {
            alert('this command has not been implemented');
        }

    } else {
        $.ajax({
            url: "/messages/add",
            type: "POST",
            data: { message: msg },
            success: function(data) {
                socket.emit( 'message', { message: data } );
            }
        });
    }
    
    return false;
});

socket.on( 'message', function( data ) {
    var newMsgContent = '<li class="list-group-item"><h5 class="list-group-item-heading">' + data.username + '</h5><p class="list-group-item-text">' + data.message + '</p>';
    $("#messages li:last-child").before ( newMsgContent );
    scrollToBot();
});

socket.on( 'privatemessage', function( data ) {
    var newMsgContent = '<li class="list-group-item"><h5 class="list-group-item-heading">' + data.username + ' > ' + data.to + '</h5><p class="list-group-item-text">' + data.message + '</p>';
    $("#messages li:last-child").before ( newMsgContent ); 
    scrollToBot();
});

function scrollToBot() {
    var elem = $('.cbp-spmenu');
    var atBottom = (elem[0].scrollHeight - elem.scrollTop() == elem.outerHeight());
    if (atBottom) {
        $('.cbp-spmenu').scrollTop($('.cbp-spmenu')[0].scrollHeight);
    }
}