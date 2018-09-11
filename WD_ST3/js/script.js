const MIN_LEN = 1;
const ENTER_KEY = 13;
const ESC_KEY = 27;
const TOP_INDENTATION = 40;
const LEFT_INDENTATION = 8;

const container = $('.main');
const containerWidth = container.outerWidth(true);

let id = 0;

function checkInputTextLen(text) {
    return text.length >= MIN_LEN;
}

function determineShift(bubble) {
    const bubbleEl = $(bubble);
    const bubbleOffset = bubbleEl.offset();

    const bubbleWidth = bubbleEl.outerWidth(true);
    const bubbleHeight = bubbleEl.outerHeight(true);

    let left = bubbleOffset.left;
    let top = bubbleOffset.top;

    if (left + bubbleWidth > containerWidth) {
        left = containerWidth - bubbleWidth;
    }
    if (top + TOP_INDENTATION - bubbleHeight < 0) {
        top = bubbleHeight - TOP_INDENTATION;
    }
    bubbleEl.offset({top: top, left: left});
}

function editMsg(bubble, inputText, key = ENTER_KEY){
    const bubbleEl = $(bubble);

    if (key === ENTER_KEY && checkInputTextLen(inputText)) {
        bubbleEl.text(inputText)
            .addClass('bubble-ready')
            .find('input')
            .remove();
        determineShift(bubble);
        updMsg(bubble);
    } else if (key === ENTER_KEY && !checkInputTextLen(inputText)){
        bubble.isDel = true;
        updMsg(bubble);
        bubbleEl.empty().remove();
    } else if (key === ESC_KEY) {
        bubbleEl.text(inputText);
        bubbleEl.find('input').remove();
        return false;
    }
    return true;
}

function updMsg(obj) {
    const bubble = $(obj);
    const bubbleOffset = bubble.offset();
    let isDel = obj.isDel;

    if (!isDel || isDel === null) {
        isDel = false;
    }
    $.ajax({
        url: "php/app.php",
        method: "POST",
        data: {
            msg: bubble.text(),
            id: bubble.attr('id'),
            offsetX: bubbleOffset.left + LEFT_INDENTATION,
            offsetY: bubbleOffset.top + TOP_INDENTATION,
            isDel: isDel,
        },
    })
}

function getAllMsg() {
    $.ajax({
        url: "php/app.php",
        method: "POST",
        dataType: "json",
        data: {
            getAllMsg: true,
        },
    }).done(function (res) {
        for (let i in res) {
            addBubble(res[i]);
            id = Number(res[i].id) + 1;
        }
    })
}
function createBubble(obj) {
    return $('<div/>')
        .addClass('bubble')
        .attr('id', id)
        .css({top: obj.offsetY - TOP_INDENTATION, left: obj.offsetX - LEFT_INDENTATION})
        .appendTo('.main')
        .draggable({
            containment: 'parent' 
        });
}
function addBubble(obj) {
    $(createBubble(obj))
        .text(obj.msg)
        .addClass('bubble-ready');
}

$(function(){
    getAllMsg();
    container.dblclick(function(e){    
        const bubble = e.target;

        if (bubble.className.indexOf('bubble') !== -1) {
            let text = bubble.textContent;
            bubble.textContent = '';
            $('<input/>').addClass('signature') 
                .val(text)
                .appendTo(bubble)
                .focus()
                .blur(function() {
                    editMsg(bubble, $(this).val(), ENTER_KEY)
                })
                .keydown(function(e) {
                    if(!editMsg(bubble, $(this).val(), e.keyCode)) {
                        bubble.textContent = text;
                    }
                });
        } else {
            const bubble = createBubble(e);

            bubble.isDel = false;
            id++;
            $('<input/>').addClass('signature')
                .appendTo(bubble)
                .focus()
                .keydown(function(e) {
                    const keyCode = e.keyCode;
                    if (keyCode === ESC_KEY) {
                        bubble.remove();
                        return;
                    }
                    editMsg(bubble, $(this).val(), keyCode);
                })
                .blur(function() {
                    editMsg(bubble, $(this).val(), ENTER_KEY);
                });
        }
    })

    container.droppable({
        drop: function(event, ui) {
            editMsg(ui.draggable, $(ui.draggable).text());
        }
    });
})

