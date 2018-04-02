function getResultTask1(){
	var amount = 0;
	for(var i = -1000; i <= 1000; i++){
		amount = amount + i;
	}
	addResult(amount, 'task1');
}

function addResult(result, id){
	var spanResult = document.getElementById('result-' + id);
	spanResult.className = 'span-result';
	spanResult.innerText = result;
}

function getResultTask2(){
	var amount = 0;
	for(var i = -1000; i <= 1000; i++){
		if((Math.abs(i)) % 10 === 2
			|| (Math.abs(i)) % 10 === 3
			|| (Math.abs(i)) % 10  === 7)
			amount = amount + i;
	}
	addResult(amount, 'task2');
}

function getResultTask3(){
	var task3 = document.getElementById('task3');
	var stars = "";
	for(var i = 0; i < 50; i++){
		for(var j = 0; j <= i; j++){
			stars = stars + '*';
		}
		var br = document.createElement('br');
		var span = document.createElement('span');
		span.className = "span-task3";
		span.innerText = stars;
		span.appendChild(br);
		task3.appendChild(span);
		stars = "";
	}
}

function getResultTask4(){
	var input = document.getElementById('task4-input').value;
	if(isInt(input)){
		clearErrMsg('task4');
		var result = [];
		result[0] = addingLeadingZeros(String(Math.floor(input / 3600)), 2);
		result[1] = addingLeadingZeros(String(Math.floor((input % 3600) / 60)), 2);
		result[2] = addingLeadingZeros(String(input % 60), 2);
		addResult(result[0] + ':' + result[1] + ':' + result[2], 'task4');
	} else {
		addErrMsg('enter an integer', 'task4');
	}
}

function addErrMsg(message, id){
	document.getElementById('block-error-' + id).innerText = message;
	document.getElementById('block-error-' + id).className = 'block-error-invalid';
	document.getElementById(id + '-input').className = 'input-is-error';
	document.getElementById(id + '-input').value = '';
}

function clearErrMsg(id){
	document.getElementById('block-error-' + id).className = 'block-error-valid';
	document.getElementById(id + '-input').className = '';
}

function addingLeadingZeros(val){
	if(val.length <= 9){
		val = '0' + val;
	}
	return val;
}

function getResultTask5(){
	var input = document.getElementById('task5-input').value;
	if(isInt(input)){
		clearErrMsg('task5');
		var age = Number(input);
		var res = getStringNameForIntVal(age, ' год', ' года', ' лет');
		addResult(res, 'task5');

	} else {
		addErrMsg('enter an integer', 'task5');
	}
}

function getResultTask6(){
	var inputFirst = document.getElementById('task6-first-input').value;
	var inputSecond = document.getElementById('task6-second-input').value;
	var errMsg = "enter date in format: October 13, 2014 11:13:00";
	if (!isValidDateTask6(inputFirst)){
		addErrMsg(errMsg, 'task6-first');
	} else if (!isValidDateTask6(inputSecond)){
		addErrMsg(errMsg, 'task6-second');
	} else {
		clearErrMsg('task6-first');
		clearErrMsg('task6-second');
		var timeFirst = convertToDate(inputFirst);	
		var timeSecond = convertToDate(inputSecond);
		if(timeFirst != 'Invalid Date' && timeSecond != 'Invalid Date'){
			var timeDifference = timeSecond - timeFirst;
			var result = [
				Math.floor(timeDifference / 31536000000),
				Math.floor((timeDifference % 31536000000) / 2592000000),
				Math.floor(((timeDifference % 31536000000) % 2592000000) / 86400000),
				Math.floor((((timeDifference % 31536000000) % 2592000000) % 86400000) / 3600000),
				Math.floor(((((timeDifference % 31536000000) % 2592000000) % 86400000) % 3600000) / 60000),
				Math.floor((((((timeDifference % 31536000000) % 2592000000) % 86400000) % 3600000) % 60000) / 1000)
			];
			var res = 
				getStringNameForIntVal(result[0], ' год, ', ' года, ', ' лет, ') +
				getStringNameForIntVal(Math.abs(result[1]), ' месяц, ', ' месяца, ', ' месяцев, ') +
				getStringNameForIntVal(Math.abs(result[2]), ' день, ', ' дня, ', ' дней, ') +
				getStringNameForIntVal(Math.abs(result[3]), ' час, ', ' часа, ', ' часов, ' ) +
				getStringNameForIntVal(Math.abs(result[4]), ' минута, ', ' минуты, ', ' минут, ' ) +
				getStringNameForIntVal(Math.abs(result[5]), ' секунда, ', ' секунды, ', ' секунд' );
			addResult(res, 'task6');

		}
	}
}

function getStringNameForIntVal(num, str1, str2, str3){
	var res = '';
	if(num > 4 && num < 21)
		return num + str3;
	else if(num % 10 === 1)
		return num + str1;
	else if(num % 10 > 1 && num % 10 < 5)
		return num + str2;
	else 
		return num + str3;
}

//format date is October 13, 2014 11:13:00
function isValidDateTask6(input){
	var arr=[
		'January',
		'February',
		'March',
		'April',
		'May',
		'June',
		'July',
		'August',
		'September',
		'October',
		'November',
		'December'
	];
	var date = convertToDate(input);
	input = input.split(/,| |:/);
	return  date.getFullYear()      == input[3]
			&& date.getDate()       == input[1]
			&& date.getHours()	    == input[4] 
			&& date.getMinutes()    == input[5]
			&& date.getSeconds()    == input[6]
			&& arr[date.getMonth()] == input[0];
}

function convertToDate(inputText){
	var d = new Date();
	d.setTime(Date.parse(inputText));
	return(d);
}
	
function getResultTask7(){
	var input = document.getElementById('task7-input').value;
	document.getElementById('task7-input').value = '';
	var date = 	convertToDate(input);
	if(date === 'Invalid Date' || !isValidDateTask7(input)) {
		addErrMsg('enter date in format\: 2014-12-31', 'task7');
		return false;
	}
	clearErrMsg('task7');
	var day = date.getDate();
	var month = date.getMonth()+1;
	if (day < 1 || day > 31) addErrMsg('enter date in format: 2014-12-31', 'task7');
	else if (month===2 && day>29) addErrMsg('enter date in format: 2014-12-31', 'task7');
	else if ((month==4||month==6||month==9||month==11) && day>30) addErrMsg('enter date in format: 2014-12-31', 'task4');
	else if (month===1 && day>=20  || month===2 && day<=18) result="Водолей";
	else if (month===2 && day>=19  || month===3 && day<=20) result="Рыбы";
	else if (month===3 && day>=21  || month===4 && day<=19) result="Овен";
	else if (month===4 && day>=20  || month===5 && day<=20) result="Телец";
	else if (month===5 && day>=21  || month===6 && day<=21) result="Близнецы";
	else if (month===6 && day>=22  || month===7 && day<=22) result="Рак";
	else if (month===7 && day>=23  || month===8 && day<=22) result="Лев";
	else if (month===8 && day>=23  || month===9 && day<=22) result="Дева";
	else if (month===9 && day>=23  || month===10 && day<=22) result="Весы";
	else if (month===10 && day>=23 || month===11 && day<=21) result="Скорпион";
	else if (month===11 && day>=22 || month===12 && day<=21) result="Стрелец";
	else if (month===12 && day>=22 || month===1 && day<=19) result="Козерог";
	else addErrMsg('enter date in format: 2014-12-31', 'task7');

	var imgName;
	switch(result) {
		case 'Водолей':
			imgName = '1';
			break;
		case 'Рыбы':
			imgName = '2';
			break;
		case 'Овен':
			imgName = '3';
			break;
		case 'Телец':
			imgName = '4';
			break;
		case 'Близнецы':
			imgName = '5';
			break;
		case 'Рак':
			imgName = '6';
			break;
		case 'Лев':
			imgName = '7';
			break;
		case 'Дева':
			imgName = '8';
			break;
		case 'Весы':
			imgName = '9';
			break;
		case 'Скорпион':
			imgName = '10';
			break;
		case 'Стрелец':
			imgName = '11';
			break;
		case 'Козерог':
			imgName = '12';
			break;
	}
	addResult(result, 'task7');
	document.getElementById('task7-iconsZodiak').src = "icons/" + imgName + '.png';
}

function isValidDateTask7(str){
	var re = /^(19|20)[0-9]{2}-[0|1][0-9]-[0-3][0-9]/;
	if(!re.test(str)) {
		return false;
	}
	if (!str) {
		return false;
	}
	str = str.split("-");
	if (!str[1] || !str[2]){
		return false;
	}
	return true;
}

function getResultTask8(){
	var input = document.getElementById('task8-input').value;
	document.getElementById('task8-input').value = '';
	input = input.split(/x/);

	if(isValidInputTask8(input)){
		clearErrMsg('task8');
		var task8Div = document.getElementById('div-task8-result');
		task8Div.innerText = '';
		for(var i = 0; i < input[0]; i++){
			var task8DivNew = document.createElement('div');
			var br = document.createElement('br');
			task8DivNew.className = 'task8-line';
			task8Div.appendChild(task8DivNew);
			for(var j = 0; j < input[1]; j++){
				var divCell = document.createElement('div');
				if((j + i + 2) % 2 === 0) divCell.className = "div-task8-cell-odd";
				else divCell.className = "div-task8-cell-even";
				task8DivNew.appendChild(divCell);
			}
		}
	}else {
		addErrMsg('input format is: 8x8', 'task8');
	}
}

function isValidInputTask8(arr){
	if (!arr || !arr[1]) {
		return false;
	}
	if (arr[0] < 0 || arr[1] < 0){
		return false;
	}
	return true;
}

function getResultTask9(){
	var errMsg = 'enter an integer';
	var inputApartment = document.getElementById('task9-apartment-input').value;
	document.getElementById('task9-apartment-input').value = '';
	if(!isInt(inputApartment)){
		addErrMsg(errMsg, 'task9-apartment');
		return false;
	}
	clearErrMsg('task9-apartment');
	var inputApartmentAmount = document.getElementById('task9-apartmentAmount-input').value;
	document.getElementById('task9-apartmentAmount-input').value = '';
	if(!isInt(inputApartmentAmount)){
		addErrMsg(errMsg, 'task9-apartmentAmount');
		return false;
	}
	clearErrMsg('task9-apartmentAmount');
	var inputFloor = document.getElementById('task9-floors-input').value;
	document.getElementById('task9-floors-input').value = '';
	if(!isInt(inputFloor)){
		addErrMsg(errMsg, 'task9-floors');
		return false;
	}
	clearErrMsg('task9-floors');
	var numApartmentInEntrace = inputFloor * inputApartmentAmount;
	var resultEntrance = Math.ceil(inputApartment / numApartmentInEntrace);
	var resultFloor = Math.ceil( (inputApartment % numApartmentInEntrace) / inputApartmentAmount);
	if(resultFloor == 0) resultFloor = inputFloor;
	addResult(resultEntrance + ' entrance, ' + resultFloor + ' floor', 'task9');
}

function getResultTask10(){
	var input = document.getElementById('task10-input').value;
	document.getElementById('task10-input').value = '';
	var arr = input.split('');
	if(isInt(input)){
		clearErrMsg('task10');
		var result = input.split('').map(Number).reduce(function (a, b) {
            return a + b;
        }, 0);
		addResult(result, 'task10');
	} else {
		addErrMsg('enter an integer greater than zero', 'task10');
	}
}

function getResultTask11(){
	var input = document.getElementById('task11-textarea').value;
	if(!input) return false;
	input = input.split(',').map(function(element){
		return element.replace('http://', '').replace('https://', '');
	});
	input = input.sort();
	var ulTask = document.getElementById('task11-ul');
	for(var i = 0; i < input.length; i++){
		var el = document.createElement('li');
		el.innerText = input[i];
		ulTask.appendChild(el);
	}
}

function isInt(input){
	return input && !isNaN(input) && Number.isInteger(Number(input)) && input > 0;
}