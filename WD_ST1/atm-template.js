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
    logAdd: function(str){
        this.logging[this.loggingAmount++] = str;
        console.log(str);
    },
    // authorization
    auth: function(number, pin) {
        let log = '';
        let current_user;
        if(this.is_auth) {
            log = `ERROR! reauthorization attempt`;
        }else{
            this.users.find(function(userCurrent, index){
                if(number === userCurrent.number){
                    current_user = index;
                }
            });
            this.current_user = current_user;
            if(this.current_user !== false && this.users[this.current_user].pin === pin){
                this.is_auth = true;
                this.current_type = this.users[this.current_user].type;
                log = `authorized at an ATM as ${this.users[this.current_user].number}`;
            }else{
                log = `ERROR! user or password is incorrect`;
            }
        }
        this.logAdd(log);      
    },
    checkPosInt: function(number){
        if(!isNaN(parseFloat(number)) && isFinite(number) && number >= 0){
            return true;
        }
        log = `ERROR! a wrong number is entered`;
        this.logAdd(log);
        return false;
    },
    //check authorization
    checkAutorized: function(){
        if(this.is_auth){
            return true;
        }else{
            log = `ERROR! Authorisation Error`;
            this.logAdd(log);
            return false;
        }
    },
    //admin type checking
    checkAdmin: function(){
        if(this.current_type !== 'admin'){
            log = `ERROR! attempt to access the admin functions`;
            this.logAdd(log);
            return false;
        }
        return true;
    },
    //user type checking
    checkUser: function(){
        if(this.current_type !== 'user'){
            log = `ERROR! attempt to access the user functions`;
            this.logAdd(log);
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
                log = `ERROR! attempt to withdraw money exceeding the user's account`;
            }else if (this.cash < amount){
                log = `ERROR! attempt to withdraw the amount exceeding the ATM account`;
            }else{
                this.users[this.current_user].debet = this.users[this.current_user].debet - amount;
                this.cash = this.cash - amount;
                log = `${this.users[this.current_user].number} take off ${amount} dolars`;
                this.logAdd(log);
            }
        }
    },
    // load cash - available for user only
    loadCash: function(amount){
        if(this.checkAutorized() && this.checkUser() && this.checkPosInt(amount)){
            this.users[this.current_user].debet = this.users[this.current_user].debet + amount;
            this.cash = this.cash + amount;
            log = `${this.users[this.current_user].number} put ${amount} dolars`;
            this.logAdd(log);
        }
    },
    // load cash to ATM - available for admin only - EXTENDED
    load_cash: function(addition) {
        if(this.checkAutorized() && this.checkAdmin() && this.checkPosInt(amount)){
            this.cash = this.cash + addition;
            log = `${this.users[this.current_user].number} put ${amount} dolars in ATM account`;
            this.logAdd(log);
        }
    },
    // get report about cash actions - available for admin only - EXTENDED
    getReport: function() {
        if(this.checkAutorized() && this.checkAdmin()){
            console.log(this.logging);
        }
    },
    // log out
    logout: function() {
        if(this.checkAutorized()){
            //console.log()
            log = `${this.users[this.current_user].number} logout`;
            this.logAdd(log);
            this.is_auth = false;
            this.current_user = false;
        }
    }
};
