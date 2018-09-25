$(function(){
    $('form').submit(function () {
        const string = escapeHtml($('#string').val());
        const pattern = $('#regExp').val();
        const parts = /\/(.*)\/(.*)/.exec(pattern);

        try {
            let reg = new RegExp(parts[1], parts[2]);
            newString = string.replace(reg, function(p) {
                return `<mark>${p}</mark>`;
            });
            $('#result').empty().append(newString);
        } catch(err) {
            const errMsg = 'ERROR! Invalid regular expression';
            $('#result').empty().append(errMsg);
            console.log(err);
        }
    });
    function escapeHtml(text) {
        return text
            .replace(/&/g, "&amp;")
            .replace(/</g, "&lt;")
            .replace(/>/g, "&gt;")
            .replace(/"/g, "&quot;")
            .replace(/'/g, "&#039;");
    }
});