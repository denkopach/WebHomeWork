/**
 * Created by chief on 24.04.18.
 */
function showInfo() {
    const block = document.getElementById("example-inputs");
    const btn = document.getElementById("extra-inputs-btn").firstChild;
    if (block.classList.contains("hidden") ) {
        block.classList.remove("hidden");
    } else {
        block.classList.add("hidden");
    }
    btn.data = btn.data == "More inputs" ? "Less inputs" : "More inputs";
    return false;
}