/** Global variables that been used multiple times*/
const output = getElemById("output");
const time = getElemById("seconds");
const result = document.createElement("p");
const task3 = getElemById("task3");
const task8 = getElemById("task8");
const task11 = getElemById("task11");
const ageArr = ["год", "года", "лет"];
const daysArr = ["день", "дня", "дней"];
const monthsArr = ["месяц", "месяца", "месяцев"];
const hoursArr = ["час", "часа", "часов"];
const minutesArr = ["минута", "минуты", "минут"];
const secondsArr = ["секунда", "секунды", "секунд"];
const signs = ["Овен", "Телец", "Близнецы", "Рак", "Лев", "Дева", "Весы", "Скорпион", "Стрелец",
    "Козерог", "Водолей", "Рыбы"];

/** Custom utility function to display that user entered not allowed negative values*/
function negativeNumberError() {
    console.error("No negative values allowed !");
}

/** Custom utility function to shorten document.getElementById() method*/
function getElemById(id) {
    if (id) {
        return document.getElementById(id);
    } else {
        console.error("Wrong id been passed!");
        return null;
    }
}

function clearBlockResult() {
    result.innerHTML = '';
}

function error(errorTag, errorMsg = "Wrong data been passed") {
    if (!errorTag) {
        console.error("An error occurred, wrong errorTag been passed");
    } else {
        errorTag.innerHTML = errorMsg;
    }
}

/** TASK 1
 * Calculation sum of number from -1000 to 1000*/
function sum() {
    const task1 = getElemById("task1");
    let sum = 0;
    for (let i = -1000; i <= 1000; i++) {
        sum += i;
    }
    result.innerHTML = "sum from -1000 to 1000 = " + sum;
    task1.appendChild(result);
}

/** TASK 2
 * Calculating sum of numbers ending on 2 , 3 or 7 in range from -1000 to 1000*/
function sum237() {
    const task2 = getElemById("task2");
    let sum = 0;
    for (let i = -1000; i <= 1000; i++) {
        let temp = Math.abs(i % 10);
        if (temp === 2 || temp === 3 || temp === 7) {
            sum += i;
        }
    }
    result.innerHTML = "Sum from -1000 to 1000 , numbers ending only on 2 3 or 7 = " + sum;
    task2.appendChild(result);
}

/** TASK 3
 * Drawing 50 rows of asterisk ( "*" ), each row qty of symbols is increasing by 1 */
function drawStars() {

    const ul = document.createElement("ul");
    ul.setAttribute("class", "stars");
    let asterisk = "";
    result.innerHTML = '';
    for (let i = 0; i < 50; i++) {
        asterisk += "*";
        const li = document.createElement("li");
        li.appendChild(document.createTextNode(asterisk));
        ul.appendChild(li);
    }
    result.appendChild(ul);
    task3.appendChild(result);
}


/** TASK 4
 * Converting seconds into hh:mm:ss or y:MM:dd:hh:mm:ss
 *  @param seconds int seconds to convert, if none seconds will be grabbed from input id=seconds
 *  @param fullMode boolean Mode to display hh:mm:ss or y:MM:dd:hh:mm:ss
 * */
function convertSeconds(seconds, fullMode) {
    const task4 = getElemById("task4");
    const errorTag = task4.getElementsByClassName("error")[0];
    let date;
    if (isNaN(seconds)) {
        seconds = time.value;
        date = new Date(seconds * 1000)
    } else {
        date = new Date(seconds * 1000);
    }
    let years = date.getYear() - 70;
    let months = date.getMonth();
    let days = date.getDate() - 1;
    let hours = date.getUTCHours();
    let minutes = date.getMinutes();
    let dateSeconds = date.getSeconds();
    error.innerHTML = '';
    result.innerHTML = '';
    if (seconds > 0 && !fullMode) {
        const task4 = getElemById("task4");
        if (days >= 1 && hours === 0) {
            for (let i = 0; i < days; i++) {
                hours += 24;
            }
        }
        result.appendChild(document.createTextNode("Result: "
            + hours.toString().padStart(2, '0') + ":"
            + minutes.toString().padStart(2, '0') + ":"
            + dateSeconds.toString().padStart(2, '0')));
        task4.appendChild(result);
    } else if (seconds >= 0 && fullMode) {
        return {year: years, month: months, day: days, hour: hours, minute: minutes, second: dateSeconds};
    } else {
        error(errorTag);
    }
}

/** TASK 5
 * Depending on user age outputs different case of the word */
function howOld(age, local = true, arr = ageArr) {
    const task5 = getElemById("task5");
    const errorTag = task5.getElementsByClassName("error")[0];
    const inputAge = getElemById("age");
    error.innerHTML = '';
    age = local ? inputAge.value : age.toString();
    let size = age.length;
    let msg = "";
    if (!isNaN(parseInt(age))) {
        if (size > 1 && age[size - 2] == 1) {
            msg = age + " " + arr[2];
        } else {
            if (age[size - 1] == 1) {
                msg = age + " " + arr[0];
            } else if (age[size - 1] >= 2 && age[0] <= 4) {
                msg = age + " " + arr[1];
            } else if ((age[size - 1] >= 5 && age[0] <= 9) || age[0] == 0) {
                msg = age + " " + arr[2];
            }
        }

        if (local) {
            result.innerHTML = msg;
            task5.appendChild(result);
        } else {
            return msg;
        }
    } else {
        error(errorTag);
    }
}


/** TASK 6
 *  Calculating how much time passed between two dates, format: y:MM:dd:hh:mm:ss */
function timePassed() {
    const firstDate = document.getElementById("firstDate");
    const secondDate = document.getElementById("secondDate");
    const task6 = getElemById("task6");
    const errorTag = task6.getElementsByClassName("error")[0];
    let dateFrom = new Date((firstDate.value));
    let dateTo = new Date((secondDate.value));
    let dif;
    error.innerHTML = '';
    if (!isNaN(dateTo.getTime()) && !isNaN(dateFrom.getTime())) {
        if (dateFrom < dateTo) {
            dif = dateTo.getTime() - dateFrom.getTime();
        } else {
            dif = dateFrom.getTime() - dateTo.getTime();
        }

        let response = convertSeconds(dif / 1000, true);

        const task6 = getElemById("task6");
        result.appendChild(document.createTextNode("Result: "
            + howOld(response.year, false) + ":"
            + howOld(response.month, false, monthsArr) + ":"
            + howOld(response.day, false, daysArr) + ":"
            + howOld(response.hour, false, hoursArr) + ":"
            + howOld(response.minute, false, minutesArr) + ":"
            + howOld(response.second, false, secondsArr)));
        task6.appendChild(result);

    } else {
        error(errorTag);
    }
}

/** TASK 8
 * Drawing chessboard into prepared <table> in html, table size is choosing by user input*/
function drawChessboard() {
    const errorTag = task8.getElementsByClassName("error")[0];
    const height = getElemById("height");
    const width = getElemById("width");
    const table = document.createElement("table");
    output.innerHTML = '';
    error.innerHTML = '';
    if (height.value > 0 && width.value > 0) {
        for (let i = 0; i < height.value; i++) {
            const tr = document.createElement("tr");
            for (let j = 0; j < width.value; j++) {
                const td = document.createElement("td");
                if ((i % 2 === 0 && j % 2 != 0) || (i % 2 != 0 && j % 2 === 0)) {
                    td.classList.add("black");
                }
                td.appendChild(document.createTextNode(""));
                tr.appendChild(td);
            }
            table.appendChild(tr);
        }
        result.appendChild(table);
        task8.appendChild(result);
    } else {
        error(errorTag, negativeNumberError());
    }
}


/** TASK 10
 *  Calculating sum of number digits*/
function sumOfNumberDigits() {
    const task10 = getElemById("task10");
    const errorTag = task10.getElementsByClassName("error")[0];
    const data = document.getElementById("number");
    let digits = data.value.toString().match(/\d/g);
    let sum = 0;
    error.innerHTML = '';
    result.innerHTML = '';
    if (digits != null) {
        for (let i = 0; i < digits.length; i++) {
            sum += parseInt(digits[i]);
        }
        result.innerHTML = "Sum of digits of number " + data.value + " is :" + sum;
        task10.appendChild(result);
    } else {
        error(errorTag, "Wrong number format been passed");
    }
}

/** TASK 9
 *  Calculating floor and entrance by room number
 *  Number of floors , rooms per floor, entrances are set by user input*/
function houseProblem() {
    const task9 = getElemById("task9");
    const errorTag = task9.getElementsByClassName("error")[0];
    const apartments = getElemById("apartments");
    const floors = getElemById("floors");
    const entrances = getElemById("entrances");
    const room = getElemById("room");
    error.innerHTML = '';
    result.innerHTML = '';
    if (apartments.value == 1 && floors.value == 1 && entrances.value == 1 && room.value == 1) {
        alert("1 этаж 1 подъезд");
    } else if (room.value > 0 && floors.value > 0 && entrances.value > 0 && apartments.value > 0) {
        let rooms = floors.value * apartments.value * entrances.value;
        let roomsPerEntrance = rooms / entrances.value;
        let entrance = Math.ceil(room.value / roomsPerEntrance);
        let floor = Math.ceil(Math.abs(room.value % roomsPerEntrance) / apartments.value);
        if ((floor > floors.value || floor === 0) || (entrance > entrances.value || entrance === 0)) {
            error.innerHTML = "Wrong data been passed :(";
        } else {
            result.innerHTML = floor + " этаж " + entrance + " подъезд";
            task9.appendChild(result);
        }
    } else {
        error(errorTag);
    }
}

/** TASK 11
 *  Building list of links sorted in alphabetical order, clean from https http or www
 *  regex :https://stackoverflow.com/a/41942787 */
function buildLinksList() {
    const linkList = getElemById("links-list");
    const links = getElemById("links");
    const list = document.createElement("ul");
    linkList.innerHTML='';
    const listItems = links.value.split(",")
        .map(link => link.trim())
        .map(link => link.replace(/^https?:\/\//i,""))
        .sort()
        .map(link => `<li><a href="//${link}">${link}</a></li>`)
        .join('');
    list.innerHTML=listItems;
    linkList.appendChild(list);
}


/** TASK 7
 *  Output user zodiac sign and image of it, depending on user's birthday date*/
function zodiac() {
    const bday = getElemById("birthday");
    const task7 = getElemById("task7");
    const errorTag = task7.getElementsByClassName("error")[0];
    const date = new Date();
    if (bday.value != '') {
        let bdayData = bday.value.split('-');
        if (bdayData.length === 3) {
            if (!isNaN(parseInt(bdayData[0])) && !isNaN(parseInt(bdayData[1]))
                && !isNaN(parseInt(bdayData[2]))) {
                date.setFullYear(bdayData[0]);
                date.setMonth(bdayData[1] - 1);
                date.setDate(bdayData[2]);

                if (date.getFullYear() == bdayData[0]
                    && date.getMonth() == bdayData[1] - 1
                    && date.getDate() == bdayData[2]) {
                    let day = date.getDate();
                    let month = date.getMonth();
                    let sign;
                    if (!isNaN(day) && !isNaN(month)) {
                        if ((month === 0 && day >= 21) || (month === 1 && day <= 18)) {
                            sign = signs[10];
                        } else if ((month === 1 && day >= 19) || (month === 2 && day <= 20)) {
                            sign = signs[11];
                        } else if ((month === 2 && day >= 21) || (month === 3 && day <= 20)) {
                            sign = signs[0];
                        } else if ((month === 3 && day >= 21) || (month === 4 && day <= 20)) {
                            sign = signs[1];
                        } else if ((month === 4 && day >= 21) || (month === 5 && day <= 21)) {
                            sign = signs[2];
                        } else if ((month === 5 && day >= 22) || (month === 6 && day <= 22)) {
                            sign = signs[3];
                        } else if ((month === 6 && day >= 23) || (month === 7 && day <= 23)) {
                            sign = signs[4];
                        } else if ((month === 7 && day >= 24) || (month === 8 && day <= 23)) {
                            sign = signs[5];
                        } else if ((month === 8 && day >= 24) || (month === 9 && day <= 23)) {
                            sign = signs[6];
                        } else if ((month === 9 && day >= 24) || (month === 10 && day <= 22)) {
                            sign = signs[7];
                        } else if ((month === 10 && day >= 23) || (month === 11 && day <= 21)) {
                            sign = signs[8];
                        } else if ((month === 11 && day >= 22) || (month === 0 && day <= 20)) {
                            sign = signs[9];
                        }
                        result.innerHTML = "Ваш знак зодика:" + sign;
                        const img = document.createElement("img");
                        img.src = "images/" + sign + ".png";
                        task7.appendChild(result).appendChild(img);
                    }
                } else {
                    error(errorTag);
                }
            }
        }
    } else {
        error(errorTag);
    }
}