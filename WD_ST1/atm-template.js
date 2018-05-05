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
    loggingAmount: 0,

    report: [
      //0
      `ERROR! reauthorization attempt`,
      //1
      `ERROR! user or password is incorrect`,
      //2
      `authorized at an ATM as `,
      //3
      `ERROR! a wrong number is entered`,
      //4
      `ERROR! Authorisation Error`,
      //5
      `ERROR! attempt to access the admin functions`,
      //6
      `ERROR! attempt to access the user functions`,
      //7
      `ERROR! attempt to withdraw money exceeding the user's account`,
      //8
      `ERROR! attempt to withdraw the amount exceeding the ATM account`,
      //9  take off money
      ` take off `,
      //10 put money user
      ` put `,
      //11 put money admin
      ` put in ATM account - `,
      //12 logout
      ` logout`
    ],

    logAdd: function(str){
        const now = new Date();
        function addLeadingZeros(val, lenNum = 2){
            return val.toString().padStart(lenNum, "0");
        }
        
        const dateNow = addLeadingZeros(now.getDay()) + '.' + 
                        addLeadingZeros(now.getMonth()) + '.' + 
                        addLeadingZeros(now.getFullYear(), 4) + ' ' + 
                        addLeadingZeros(now.getHours()) + ':' + 
                        addLeadingZeros(now.getMinutes()) + ':' + 
                        addLeadingZeros(now.getSeconds());
        this.logging.push(dateNow + ' ' + str);
        console.log(str);
    },

    // authorization    
    auth: function(number, pin) {
        let log = '';
        let current_user = false;

        if(this.is_auth) {
            log = this.report[0];
        }else{
            this.users.find(function(userCurrent, index){
                if(number === userCurrent.number){
                    current_user = index;
                    
                }
            });
            this.current_user = current_user;
            if(current_user === false){
                log = this.report[1];
            } else if(this.users[this.current_user].pin === pin){
                this.is_auth = true;
                this.current_type = this.users[this.current_user].type;

                log = this.report[2] + this.users[this.current_user].number;
            }else{
                log = this.report[1];
            }
        }

        this.logAdd(log);      
    },
    checkPosInt: function(number){

        if(!isNaN(parseFloat(number)) && isFinite(number) && number >= 0){
            return true;
        }

        this.logAdd(this.report[3]);
        
        return false;
    },
    //check authorization
    checkAutorized: function(){

        if(this.is_auth){
            return true;
        }else{
            
            this.logAdd(this.report[4]);
            
            return false;
        }
    },
    //admin type checking
    checkAdmin: function(){
        if(this.current_type !== 'admin'){
            this.logAdd(this.report[5]);
            
            return false;
        }
        
        return true;
    },
    
    //user type checking
    checkUser: function(){
        if(this.current_type !== 'user'){
            
            this.logAdd(this.report[6]);
            
            return false;
        }
        return true;
    },
    
    // check current debet
    check: function() {
        if(this.checkAutorized() && this.checkUser()){
            console.log(this.users[this.current_user].debet);
        }
    },
    
    // get cash - available for user only
    getCash: function(amount) {
        if(this.checkAutorized() && this.checkUser() && this.checkPosInt(amount)){
            
            if(this.users[this.current_user].debet < amount){
                log = this.report[7];
            
            }else if (this.cash < amount){
                log = this.report[8];
            
            }else{
                this.users[this.current_user].debet = this.users[this.current_user].debet - amount;
                this.cash = this.cash - amount;
                
                log = this.users[this.current_user].number + this.report[9] + amount;
            }
        }
        this.logAdd(log);
    },
    
    // load cash - available for user only
    loadCash: function(amount){
        if(this.checkAutorized() && this.checkUser() && this.checkPosInt(amount)){
            this.users[this.current_user].debet = this.users[this.current_user].debet + amount;
            this.cash = this.cash + amount;
            
            this.logAdd(this.users[this.current_user].number + this.report[10] + amount);
        }
    },
    
    // load cash to ATM - available for admin only - EXTENDED
    load_cash: function(addition) {
        if(this.checkAutorized() && this.checkAdmin() && this.checkPosInt(addition)){
            this.cash = this.cash + addition;
            
            this.logAdd(this.users[this.current_user].number + this.report[11] + addition);
        }
    },
    
    // get report about cash actions - available for admin only - EXTENDED
    getReport: function() {
        if(this.checkAutorized() && this.checkAdmin()){
            this.logging.forEach(function(value){
                console.log(value);
            });
        }
    },
    
    // log out
    logout: function() {
        if(this.checkAutorized()){
                        
            this.logAdd(this.users[this.current_user].number + this.report[12]);
            this.is_auth = false;
            this.current_user = false;
        }
    }
};
