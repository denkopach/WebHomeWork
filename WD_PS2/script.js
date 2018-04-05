function getResultTask1(){
	let amount = 0;
	const taskId = 'task1';

	for(let i = -1000; i <= 1000; i++){
		amount = amount + i;
	}

	addResult(amount, taskId);
}

function addResult(result, id){
	let spanResult = document.getElementById('result-' + id);

	spanResult.className = 'span-result';
	spanResult.innerText = result;
}

function getResultTask2(){
	let amount = 0;
	const taskId = 'task2';

	for(let i = -1000; i <= 1000; i++){
		let n = Math.abs(i);

		if((n) % 10 === 2
			|| n % 10 === 3
			|| n % 10  === 7){

			amount = amount + i;
		}
			
	}

	addResult(amount, taskId);
}

function getResultTask3(){
	let task3 = document.getElementById('task3');
	let stars = '';

	for(let i = 0; i < 50; i++){
		for(let j = 0; j <= i; j++){
			stars = stars + '*';
		}

		const br = document.createElement('br');
		const span = document.createElement('span');

		span.className = 'span-task3';
		span.innerText = stars;
		span.appendChild(br);
		task3.appendChild(span);
		stars = '';
	}
}

function getResultTask4(){
	let input = document.getElementById('task4-input').value;
	const taskId = 'task4';
	const errMsg = 'enter a positive integer';

	if(isPositiveInt(input)){
		clearErrMsg(taskId);
		let result = [];

		result[0] = addingLeadingZeros(String(Math.floor(input / 3600)));
		result[1] = addingLeadingZeros(String(Math.floor((input % 3600) / 60)));
		result[2] = addingLeadingZeros(String(input % 60));

		addResult(`${result[0]}:${result[1]}:${result[2]}`, taskId);

	} else {
		addErrMsg(errMsg, taskId);
	}
}

function addErrMsg(message, id){
	const div = document.getElementById(`block-error-${id}`);

	div.innerText = message;
	div.className = 'block-error-invalid';

	const input = document.getElementById(`${id}-input`);

	input.className = 'input-is-error';
	input.value = '';
}

function clearErrMsg(id){
	document.getElementById(`block-error-${id}`).className = 'block-error-valid';
	document.getElementById(`${id}-input`).className = '';
}

function addingLeadingZeros(val){
	if(+val <= 9){
		val = `0${val}`;
	}

	return val;
}

function getResultTask5(){
	const input = document.getElementById('task5-input').value;
	const taskId = 'task5';
	const errMsg = 'enter a positiv integer';

	if(isPositiveInt(input)){
		clearErrMsg(taskId);

		const res = getStringNameForIntVal(input, ' год', ' года', ' лет');
		addResult(res, taskId);

	} else {
		addErrMsg(errMsg, taskId);
	}
}

function getResultTask6(){
	const inputFirst = document.getElementById('task6-first-input').value;
	const inputSecond = document.getElementById('task6-second-input').value;
	const errMsg = 'enter date in format: October 13, 2014 11:13:00';
	const taskId = 'task6';

	if (!isValidDateTask6(inputFirst)){
		addErrMsg(errMsg, 'task6-first');

	} else if (!isValidDateTask6(inputSecond)){
		addErrMsg(errMsg, 'task6-second');

	} else {
		clearErrMsg('task6-first');
		clearErrMsg('task6-second');

		const timeFirst = convertToDate(inputFirst);	
		const timeSecond = convertToDate(inputSecond);
		let timeDifference;
		if(timeFirst !== 'Invalid Date' && timeSecond !== 'Invalid Date'){
			timeDifference = Math.abs(timeSecond - timeFirst);

			const result = [
				Math.floor(timeDifference / 31536000000),
				Math.floor((timeDifference % 31536000000) / 2592000000),
				Math.floor(((timeDifference % 31536000000) % 2592000000) / 86400000),
				Math.floor((((timeDifference % 31536000000) % 2592000000) % 86400000) / 3600000),
				Math.floor(((((timeDifference % 31536000000) % 2592000000) % 86400000) % 3600000) / 60000),
				Math.floor((((((timeDifference % 31536000000) % 2592000000) % 86400000) % 3600000) % 60000) / 1000)
			];
			const res = 
				getStringNameForIntVal(result[0], ' год, ', ' года, ', ' лет, ') +
				getStringNameForIntVal(result[1], ' месяц, ', ' месяца, ', ' месяцев, ') +
				getStringNameForIntVal(result[2], ' день, ', ' дня, ', ' дней, ') +
				getStringNameForIntVal(result[3], ' час, ', ' часа, ', ' часов, ' ) +
				getStringNameForIntVal(result[4], ' минута, ', ' минуты, ', ' минут, ' ) +
				getStringNameForIntVal(result[5], ' секунда, ', ' секунды, ', ' секунд' );

			addResult(res, taskId);
		}
	}
}

function getStringNameForIntVal(num, str1, str2, str3){
	let res = '';

	if(num > 4 && num < 21){
		return num + str3;
	}

	else if(num % 10 === 1){
		return num + str1;
	}

	else if(num % 10 > 1 && num % 10 < 5){
		return num + str2;
	}

	else {
		return num + str3;
	}
}

//format date is October 13, 2014 11:13:00
function isValidDateTask6(input){
	const arrMonth = [
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
	const date = convertToDate(input);

	input = input.split(/,| |:/);

	return  date.getFullYear()      === +input[3]
			&& date.getDate()       === +input[1]
			&& date.getHours()	    === +input[4] 
			&& date.getMinutes()    === +input[5]
			&& date.getSeconds()    === +input[6]
			&& arrMonth[date.getMonth()] === input[0];
}

function convertToDate(inputText){
	let d = new Date();

	d.setTime(Date.parse(inputText));

	return d;
}
	
function getResultTask7(){
	const taskId = 'task7';
	const errMsg = 'enter realy date in format: 2014-12-31';
	
	const imgEl = document.getElementById(`${taskId}-iconsZodiak`);
	const inputEl = document.getElementById(`${taskId}-input`); 
	
	const input = inputEl.value.split('-');
	const day = +input[2];
	const month = +input[1];

	imgEl.src = '';
	inputEl.value = '';
	clearErrMsg(taskId);

	if (day < 1 || day > 31) {
		addErrMsg(errMsg, taskId);
		return false;
	}else if (month == 2 && day > 29) {
		addErrMsg(errMsg, taskId);
		return false;
	}else if ((month === 4||month === 6 || month === 9 || month === 11) && day > 30) {
		addErrMsg(errMsg, taskId);
		return false;
	}else if (month === 1 && day >= 20  || month === 2 && day <= 18) {
		result = 'Aquarius';
	}else if (month === 2 && day >= 19  || month === 3 && day <= 20) {
		result = 'fish';
	}else if (month === 3 && day >= 21  || month === 4 && day <= 19) {
		result = 'Aries';
	}else if (month === 4 && day >= 20  || month === 5 && day <= 20) {
		result = 'Taurus';
	}else if (month === 5 && day >= 21  || month === 6 && day <= 21) {
		result = 'Twins';
	}else if (month === 6 && day >= 22  || month === 7 && day <= 22) {
		result = 'Cancer';
	}else if (month === 7 && day >= 23  || month === 8 && day <= 22) {
		result = 'lion';
	}else if (month === 8 && day >= 23  || month === 9 && day <= 22) {
		result = 'Virgo';
	}else if (month === 9 && day >= 23  || month === 10 && day <= 22) {
		result = 'Libra';
	}else if (month === 10 && day >= 23 || month === 11 && day <= 21) {
		result = 'Scorpio';
	}else if (month === 11 && day >= 22 || month === 12 && day <= 21) {
		result = 'Sagittarius';
	}else if (month === 12 && day >= 22 || month === 1 && day <= 19) {
		result = 'Capricorn';
	}else {
		addErrMsg(errMsg, taskId);
		return false;
	}

	let imgName;
	switch(result) {
		case 'Aquarius':
			imgName = '1';
			break;
		case 'fish':
			imgName = '2';
			break;
		case 'Aries':
			imgName = '3';
			break;
		case 'Taurus':
			imgName = '4';
			break;
		case 'Twins':
			imgName = '5';
			break;
		case 'Cancer':
			imgName = '6';
			break;
		case 'lion':
			imgName = '7';
			break;
		case 'Virgo':
			imgName = '8';
			break;
		case 'Libra':
			imgName = '9';
			break;
		case 'Scorpio':
			imgName = '10';
			break;
		case 'Sagittarius':
			imgName = '11';
			break;
		case 'Capricorn':
			imgName = '12';
			break;
	}

	addResult(result, taskId);
	imgEl.src = `icons/${imgName}.png`;
}

function getResultTask8(){
	const onputEl = document.getElementById('task8-input');
	const msgAskConfirm = 'This may take a while. Continue?';
	const taskId = 'task8';
	const errMsg = 'input format is: 8x8';
	let isСonfirm = true;
	let input = onputEl.value.split(/x/);

	onputEl.value = '';

	if(input[0] > 500 || input[1] > 500){
		isСonfirm = confirm(msgAskConfirm);
	}

	if(isValidInputTask8(input) && isСonfirm){
		clearErrMsg('task8');
		let task8Div = document.getElementById('div-task8-result');
		
		task8Div.innerText = '';

		for(let i = 0; i < input[0]; i++){
			const task8DivNew = document.createElement('div');
			const br = document.createElement('br');
			task8DivNew.className = 'task8-line';
			task8Div.appendChild(task8DivNew);

			for(let j = 0; j < input[1]; j++){
				const divCell = document.createElement('div');

				if((j + i + 2) % 2 === 0) {
					divCell.className = 'div-task8-cell-odd';
				}
				else {
					divCell.className = 'div-task8-cell-even';
				}

				task8DivNew.appendChild(divCell);
			}
		}
	}else {
		addErrMsg(errMsg, taskId);
	}
}

function isValidInputTask8(arr){
	return (arr && arr[1] && arr[0] > 0 && arr[1] > 0);
}

function getInputElVal(idEl, errMsg){
	const inputEl = document.getElementById(`${idEl}-input`);
	const inputVal = inputEl.value;

	inputEl.value = '';

	if(!isPositiveInt(inputVal)){
		addErrMsg(errMsg, idEl);
		return false;
	}
	clearErrMsg(idEl);
	return inputVal;
}

function getResultTask9(){
	const errMsg = 'enter an integer';
	const taskId = 'task9';
	
	const inputApartment = getInputElVal('task9-apartment', errMsg);
	const inputApartmentAmount = getInputElVal('task9-apartmentAmount', errMsg);
	const inputFloor = getInputElVal('task9-floors', errMsg);
	const inputEntrance = getInputElVal('task9-entrance', errMsg);

	const numApartmentInEntrace = inputFloor * inputApartmentAmount;
	const resultEntrance = Math.ceil(inputApartment / numApartmentInEntrace);

	if(inputEntrance < resultEntrance){
		addResult('there is no such entrance', taskId);
		return false;
	}

	let resultFloor = Math.ceil( (inputApartment % numApartmentInEntrace) / inputApartmentAmount);

	if(resultFloor === 0) {
		resultFloor = inputFloor;
	}
	addResult(`${resultEntrance} entrance, ${resultFloor} floor`, taskId);
}

function getResultTask10(){
	const inputEl = document.getElementById('task10-input');
	const errMsg = 'enter an integer greater than zero';
	const taskId = 'task10';
	let input = String(Math.abs(+(inputEl.value)));

	inputEl.value = '';
	clearErrMsg(taskId);

	if(isPositiveInt(input)){
		const result = input.split('')
					.map(Number)
					.reduce(function (a, b) {
            			return a + b;
       				 }, 0);

		addResult(result, taskId);
	} else {
		addErrMsg(errMsg, taskId);
	}
}

function getResultTask11(){
	let input = document.getElementById('task11-textarea').value;
	let ulTask = document.getElementById('task11-ul');

	if(input) {
		input = input.split(',')
					.filter(link => !!link)
					.map(link => link.replace(/https?:\/\//, ''))
					.sort()
					.forEach(function(link){
						let liEl = document.createElement('li');
						let aEl = document.createElement('a');
						aEl.href = `//${link}`;
						aEl.innerText = link;
						liEl.appendChild(aEl);
						ulTask.appendChild(liEl);
					});
	}
}

function isPositiveInt(input){
	return +input && input > 0;
}