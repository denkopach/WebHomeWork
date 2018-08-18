/**
 * Created by chief on 06.06.18.
 */
const names = ['Michael', 'Bob', 'John', 'Bruce', 'Sally'];
const filepath = 'images/';
const selectOptions = $('.selectOptions');
const selectBox = $('.selectBox');

$(function () {
    let arr=[];
    for (const name of names) {
        arr.push(
            `<div class='option'>
                <img src='${filepath + name.toLowerCase()}.png'>
                <div class='option-name'>${name}</div>
            </div>`);
    }
    selectOptions.append(arr.join(''));

    $('body').on('click',function (e) {
       if ($(e.target).closest('.selectBox').length===0 && selectBox.hasClass('active-border')){
           toggleDrop();
       }
    });

    $('.selectBox,.row').on('click',function () {
        toggleDrop();
    });

    $('.option').on('click',  function () {
        $('.selected').html(this.innerHTML);
    });
});

function toggleDrop() {
    const arrow = $('.arrow');
    const angle = arrow.data('angle') + 180 || 180;
    selectOptions.toggle('slow',function () {
        selectOptions.clearQueue();
        selectBox.toggleClass('active-border');
        arrow.toggleClass('rotate');
    });
}
