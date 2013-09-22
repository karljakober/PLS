(function () {
    var src = $('#grid-source'),
        wrap = $('<div id="grid-overlay"></div>'),
        gsize = 16,

        cols = 32,
        rows = 32,

        removedSeats = [],

        selectedTile = false,
        isMouseDown = false,

        tbl = $('<table></table>'),
        x,
        y,
        tr,
        td;

    // create overlay
    for (y = 1; y <= rows; y += 1) {
        tr = $('<tr></tr>');
        for (x = 1; x <= cols; x += 1) {
            td = $('<td></td>');
            td.css('width', gsize + 'px').css('height', gsize + 'px').css('font-size', '50%').css('text-align', 'center');
            td.addClass('eraser');
            tr.append(td);
        }
        tbl.append(tr);
    }
    src.css('width', cols * gsize + 'px').css('height', rows * gsize + 'px');

    // attach overlay
    wrap.append(tbl);
    src.after(wrap);

    function setWidth(newx) {
        var xchange = newx - cols;
        if (xchange < 0) {
            for (x = xchange; x < 0; x += 1) {
                $('#grid-overlay table tbody tr').find('th:last, td:last').remove();
            }
        }
        if (xchange > 0) {
            $('#grid-overlay').find('tr').each(function () {
                $(this).find('td').eq(-1).after(Array(xchange + 1).join("<td class='eraser' style='width:16px; height:16px;'></td>"));
            });
        }
        cols = newx;
        src.css('width', cols * gsize + 'px');
    }

    function setHeight(newy) {
        var ychange = newy - rows;
        if (ychange < 0) {
            for (y = ychange; y < 0; y += 1) {
                $('#grid-overlay table tbody').find('tr:last').remove();
            }
        }
        if (ychange > 0) {
            for (y = 1; y <= ychange; y += 1) {
                tr = $('<tr></tr>');
                for (x = 1; x <= cols; x += 1) {
                    td = $('<td></td>');
                    td.css('width', gsize + 'px').css('height', gsize + 'px').css('text-size', '65%').css('text-align', 'center');
                    td.addClass('eraser');
                    tr.append(td);
                }
                tbl.append(tr);
            }
        }

        rows = newy;
        src.css('height', rows * gsize + 'px');
    }

    $('#wall').click(function () {
        selectedTile = 'wall';
    });

    $('#seat').click(function () {
        selectedTile = 'seat';
    });

    $('#execseat').click(function () {
        selectedTile = 'execseat';
    });

    $('#floor').click(function () {
        selectedTile = 'floor';
    });

    $('#trash').click(function () {
        selectedTile = 'trash';
    });

    $('#eraser').click(function () {
        selectedTile = 'eraser';
    });

    $('#setHeight').click(function () {
        y  = $('#inputHeight').val();
        setHeight(y);
    });

    $('#setWidth').click(function () {
        x  = $('#inputWidth').val();
        setWidth(x);
    });

    $("#grid-overlay td")
        .mousedown(function () {
            isMouseDown = true;
            if ($(this).html() !== '') {
                removedSeats.push($(this).html());
            }
            $(this).removeClass().html('').toggleClass(selectedTile);
            if ((selectedTile === 'seat') || (selectedTile === 'execseat')) {
                //weve removed a seat, lets use a smaller number
                if (removedSeats.length) {
                    removedSeats.sort(function (a, b) { return a - b; });
                    $(this).html(removedSeats.shift());
                } else {
                    //we have 1- whatever were on now, keep increasing
                    var numItems = $('.seat, .execseat').length;
                    $(this).html(numItems);
                }
            }
            return false; // prevent text selection
        })
        .mouseover(function () {
            if (isMouseDown) {
                if ($(this).html() !== '') {
                    removedSeats.push($(this).html());
                }
                $(this).removeClass().html('').toggleClass(selectedTile);
                if ((selectedTile === 'seat') || (selectedTile === 'execseat')) {
                    //weve removed a seat, lets use a smaller number
                    if (removedSeats.length) {
                        removedSeats.sort(function (a, b) { return a - b; });
                        $(this).html(removedSeats.shift());
                    } else {
                        //we have 1- whatever were on now, keep increasing
                        var numItems = $('.seat, .execseat').length;
                        $(this).html(numItems);
                    }
                }
            }
        });

    $(document)
        .mouseup(function () {
            isMouseDown = false;
        });

    $('#saveChart').click(function () {
        var width = $('#inputWidth').val(),
            height = $('#inputHeight').val(),
            tableName = $('#inputChartName').val(),
            //array doesnt allow associative.. need to put it in an object.
            tiles = {},
            tile = {},
            jsdata = {},
            data,
            seatId,
            tileIndex = 0;
        y = 0;
        if (width && height && tableName) {
            $('#grid-overlay').find('tr').each(function () {
                x = 0;
                $(this).find('td').each(function () {
                    tile = {};
                    if ($(this).html() !== '') {
                        seatId = $(this).html();
                        tile.seatId = seatId;
                    }
                    tile.x = x;
                    tile.y = y;
                    tile.tileName = $(this).attr("class");
                    tiles[tileIndex] = tile;
                    x += 1;
                    tileIndex += 1;
                });
                y += 1;
            });
            jsdata.width = width;
            jsdata.height = height;
            jsdata.name = tableName;
            jsdata.tiles = tiles;
            data = JSON.stringify(jsdata);
            $.ajax({ 
               url: "/admin/seating/add_seating_chart",
               type: "POST",
               data: data,
               success: function(response) {
                console.log("Response: " + response);
               }
              });
        } else {
            alert('Make sure you have Name Width and Height filled in.');
        }

    });

})();
