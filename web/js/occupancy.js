/**
 * Created by alexradyuk on 6/18/18.
 */

$(function () {


    function getNumbersList(lowEnd, highEnd) {
        var list = [];
        for (var i = lowEnd; i <= highEnd; i++) {
            list.push(i);
        }
        return list;
    }

    function showSelectedDates($par) {
        var $clicked = $par.find('.clicked');
        var date_from, date_to;
        if(!$clicked.size()){
            date_from = '';
            date_to = '';
        }else if($clicked.size() == 1){
            date_from = $($clicked.get(0)).data('dateformatted');
            date_to = '';
        }else{
            date_from = $($clicked.get(0)).data('dateformatted');
            date_to = $($clicked.get($clicked.size() - 1)).data('dateformatted');
        }

        $('#displayDateFrom span').text(date_from);
        $('#displayDateTo span').text(date_to);
    }

    $('#dates_filter .datepckr').datepicker({dateFormat: 'dd.mm.yy'});

    $('table.occupancyTable td.occupancy').each(function(){
       var w = $(this).outerWidth() -1;
        var h = $(this).outerHeight() - 1;
        console.log(h);
        $(this).find('.occupancy-holder').css({width: w, height: h});
    });

    $('table.occupancyTable .occupancy-hover').click(function(){
        $(this).toggleClass('clicked');
        var $par = $(this).parents('tr.room');
        $('.occupancyTable tr.room').each(function(){
           if($(this).data('roomid') != $par.data('roomid')){
               $(this).find('.clicked').removeClass('clicked');
           }
        });
        if($par.find('.clicked').size() == 2){
            $par.find('.hover').addClass('clicked');
        }else if($par.find('.clicked').size() > 2){
            $par.find('.clicked').removeClass('clicked');
            $(this).addClass('clicked');
        }
        showSelectedDates($par);
    });

    $('table.occupancyTable .occupancy-hover').mouseover(function(){
        var $par = $(this).parents('tr.room');
        if($par.find('.clicked').size() == 1){
            var clickedNum = $par.find('.clicked').data('num');
            var num = $(this).data('num');
            if(clickedNum > num){
                var list = getNumbersList(num + 1, clickedNum - 1);
            }else if(clickedNum < num){
                var list = getNumbersList(clickedNum + 1, num - 1);
            }else{
                list = [];
            }
            if(list.length){
                $(list).each(function(){
                   $par.find('.occupancy-hover-' + this).addClass('hover');
                });
            }
        }else{
            //$()
        }
        $(this).addClass('hover');

    });
    function insertOccupancyEntity(curEntityWidth, curEntityItems, curEntityId){
        var entDiv = document.createElement('div');
        entDiv.className = 'occupancy-entity';
        $(entDiv).css({
            width: curEntityWidth,
            height: $(curEntityItems[0]).outerHeight() - 1
        });
        $(curEntityItems[0]).append(entDiv);
        $(entDiv).append("<span class='title'>" + $(curEntityItems[0]).prop('title') + "</span>");
        $(entDiv).append("<i class='fa fa-trash-o' data-entityid='" + curEntityId + "'></i>");
        $(curEntityItems[0]).css('z-index', '1000');

        $(curEntityItems[0]).find('i').click(function(){
            system_popup_remote(URL_deleteOccupancy, {entityId: $(this).data('entityid')});
        });
    }

    function getOccupancyRow($room){
        var _rooms = [];
        var $rooms = $room.find('.occupancy-item');
        return $rooms;
        $rooms.each(function(){
            _rooms.push(this);
        });
        /*
        return $(_rooms.sort(function(a,b) {
            if ($(a).data('fulldate') < $(b).data('fulldate'))
                return -1;
            if ($(a).data('fulldate') > $(b).data('fulldate'))
                return 1;
            return $(a).hasClass('occupancy-departure') ? 1 : -1;
        }));*/
    }
    $('.occupancyTable .room').each(function(){
        var curEntityId = null;
        var curEntityWidth = 0;
        var curEntityItems = [];
        getOccupancyRow($(this)).each(function(){
            var entId = $(this).data('entityid');
            if(entId != curEntityId){
                if(curEntityItems.length){
                    insertOccupancyEntity(curEntityWidth, curEntityItems, curEntityId);
                }
                curEntityItems = [];
                curEntityWidth = 0;
                curEntityId = entId;
            }
            curEntityItems.push(this);
            curEntityWidth += $(this).width();
        });
        if(curEntityItems.length){
            insertOccupancyEntity(curEntityWidth, curEntityItems, curEntityId);
        }
    });
    $('table.occupancyTable .occupancy-hover').mouseout(function(){
        $('table.occupancyTable .occupancy-hover').removeClass('hover');
    });

    $('#addPriceButton').click(function(){
        if($('table.occupancyTable .clicked').size()) {
            system_popup_remote(URL_changePrice, {}, function () {
                $('table.occupancyTable .clicked').each(function () {
                    $('.system_popup_window .price-dates-holder').append("<input type='hidden' name='dates[]' value='" + $(this).data('fulldate') + "'>");
                    $('.system_popup_window .set-price input').focus();
                });
                $('.system_popup_window .price-dates-holder').append("<input type='hidden' name='item_id' value='" + $('table.occupancyTable .clicked').data('itemid') + "'>");
            });
        }
        return false;
    });
    $('.addOccupancyButton').click(function(){
        if($('table.occupancyTable .clicked').size() > 1) {
            var dates = [];
            var $par = $('table.occupancyTable .clicked').parents('tr.room');
            $('table.occupancyTable .clicked').each(function(){
               dates.push($(this).data('fulldate'));
            });
            system_popup_remote(URL_addOccupancy, {dates: dates, roomid: $par.data('roomid'), typeid: $(this).data('typeid')}, function () {}, 'post');
        }
    });
    $('#closeRoomButton').click(function(){
        if($('table.occupancyTable .clicked').size() > 1) {
            system_popup_remote(URL_closeRoom, {}, function () {});
        }
    });


});


