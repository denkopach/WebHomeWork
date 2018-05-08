const ATM = {
    is_auth: false, 
    current_user:false,
    current_type:false,
     
    // all cash of ATM
    cash: 2000,
    // all available users
    users: [
        {number: "0000", pin: "000", debet: 0, type: "admin"}, // EXTENDED
        {number: "0025", pin: "123", debet: 675, type: "user"}
    ],
    logging: [],

    report: [
      //0
      {report:` ERROR! reauthorization attempt`, 
        ru:`попытка повторной авторизации`},
      //1
      {report:` ERROR! user or password is incorrect`, 
        ru:`Неверный логин/пароль`},
      //2
      {report:` - authorized at an ATM `, 
        ru:`Вы успешно авторизированы`},
      //3
      {report:` ERROR! a wrong number is entered`, 
        ru:`Введено неворное значение`},
      //4
      {report:` ERROR! Authorisation Error`, 
        ru:`Ошибка авторизации`},
      //5
      {report:` ERROR! attempt to access the admin functions`, 
        ru:`Ета функция доступна только админу`},
      //6
      {report:` ERROR! attempt to access the user functions`, 
        ru:`Ета функция доступна только пользователю`},
      //7
      {report:` ERROR! attempt to withdraw money exceeding the user's account`, 
        ru:`На вашем балансе недостаточно средств`},
      //8
      {report:` ERROR! attempt to withdraw the amount exceeding the ATM account`,
        ru:`В банкомате недостаточно средств`},
      //9  take off money
      {report:` - take off `,
        ru:`Вы успешно сняли `},
      //10 put money user
      {report:` - put `,
      ru:`Вы успешно положили `},
      //11 put money admin
      {report:` - put in ATM account - `,
        ru:`Вы успешно положили в банкомат `},
      //12 logout
      {report:` - logout`,
        ru:`Сеанс завершен`},
      //13
      {report:` - check balance`,
        ru:`Ваш баланс - `}
    ],

    logAdd: function(str, user = '', amount = ''){
        var date = new Date();
        this.logging.push(date.toLocaleString('en-GB') + ' ' + user + str.report + amount);
        console.log(str.ru + amount);
    },

    // authorization    
    auth: function(number, pin) {
        let log;

        if(this.is_auth) {
            log = this.report[0];
            return;
        }
        this.current_user = this.users.find(function(current_user, index){
            if(number === current_user.number){
                if(current_user.pin === pin){
                    return current_user;
                }
            }
        });

        if(this.current_user){
            this.is_auth = true; 
            this.current_type = this.current_user.type;
            log = this.report[2];
        }else {
            log = this.report[1];
        }

        this.logAdd(log, this.current_user.number);      
    },
    checkPosInt: function(number){

        if(!isNaN(parseFloat(number)) && Number.isInteger(number) && isFinite(number) && number >= 0){
            return true;
        }

        this.logAdd(this.report[3]);
        
        return false;
    },

    //user type checking
    checkUser: function(type){
        if(!this.is_auth){
            this.logAdd(this.report[4]);
            return false;
        }
        if(this.current_type !== type){
            
            if(type === 'admin'){
                this.logAdd(this.report[5], this.current_user.number);
            }else if(type === 'user'){
                this.logAdd(this.report[6], this.current_user.number);
            }
            return false;
        }
        return true;
    },
    
    // check current debet
    check: function() {
        if(this.is_auth){
            this.logAdd(this.report[13], this.current_user.number, this.current_user.debet);
        }else{
            this.logAdd(this.report[4]);
            return false;
        }
    },
    
    // get cash - available for user only
    getCash: function(amount) {
        let log;

        if(this.checkUser('user') && this.checkPosInt(amount)){
            
            if(this.current_user.debet < amount){
                log = this.report[7];
            
            }else if (this.cash < amount){
                log = this.report[8];
            
            }else{
                this.current_user.debet -= amount;
                this.cash -= amount;
                
                log = this.report[9];
            }
            this.logAdd(log, this.current_user.number, amount);
        }
    },
    
    // load cash - available for user only
    loadCash: function(amount){
        if(this.checkUser('user') && this.checkPosInt(amount)){
            this.current_user.debet = this.current_user.debet + amount;
            this.cash += amount;
            
            this.logAdd(this.report[10], this.current_user.number, amount);
        }
    },
    
    // load cash to ATM - available for admin only - EXTENDED
    load_cash: function(addition) {
        if(this.checkUser('admin') && this.checkPosInt(addition)){
            this.cash += addition;
            
            this.logAdd(this.report[11], this.current_user.number, amount);
        }
    },
    
    // get report about cash actions - available for admin only - EXTENDED
    getReport: function() {
        if(this.checkUser('admin')){
            this.logging.forEach(function(value){
                console.log(value);
            });
        }
    },
    
    // log out
    logout: function() {
        if(this.is_auth){
            this.logAdd(this.report[12], this.current_user.number);
            this.is_auth = this.current_user = this.type = false;
        } else {
            console.log('Вы не авторизированы');
        }
    }
};
