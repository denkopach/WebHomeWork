const ATM = {

    is_auth: false,
    current_user: false,
    current_type: false,

    messages: {
        amount: 'Please enter correct amount. It should be integer and > 0',
        no_matches: 'No users with such number and pin, please check your login data',
        user_type: 'Incorrect user type',
        no_funds: 'Insufficient funds on your account',
        non_authorized: 'You need to authorize first',
        already_auth: 'Already authorized',
        invalid_login_data: 'Number and pin must be numeric only string',
        auth_failed: 'Auth failed. Number:',
        authorized: 'Authorized successfully',
        check: 'Current balance: ',
        another_amount: 'Please try another amount',
        atm_load_cash: 'Loaded cash to ATM, balance: ',
        logout: 'Loged out',
    },

    date_time_options: {
        year: 'numeric',
        month: 'long',
        day: 'numeric',
        hour: 'numeric',
        minute: 'numeric',
        second: 'numeric',
    },

    logs: [],

    // all cash of ATM
    cash: 2000,

    // all available users
    users: [
        {number: '0000', pin: '000', debet: 0, type: 'admin'}, // EXTENDED
        {number: '0025', pin: '123', debet: 675, type: 'user'}
    ],

    // authorization
    auth: function (number, pin) {
        const funcName = 'auth()';
        if (this.is_auth) {
            return this.log([`${this.current_type} ${this.current_user.number} `, this.messages.already_auth], funcName);
        }
        if (!this.isValidLoginData([number, pin])) {
            return this.log([`${this.current_type} ${this.current_user.number} `, this.messages.invalid_login_data], funcName);
        }

        this.current_user = this.users.find(function (obj) {
            return obj.number === number && obj.pin === pin;
        });

        if (this.current_user === undefined) {
            return this.log([number, this.messages.no_matches], funcName);
        }
        this.is_auth = true;
        this.current_type = this.current_user.type;
        this.log([`${this.current_type} ${this.current_user.number} `, this.messages.authorized]);
    },

    // check current debet
    check: function () {
        const funcName = 'check()';
        if (this.is_auth) {
            this.log([`${this.current_type} ${this.current_user.number} `,
                this.messages.check + this.current_user.debet]);
        } else {
            this.log([`${this.current_type} ${this.current_user.number} `, this.messages.non_authorized], funcName);
        }
    },

    // get cash - available for user only
    getCash: function (amount) {
        const funcName = 'getCash()';
        if (!this.checkUserType(this.current_type, 'user', funcName)) {
            return;
        }

        if (!this.isValidAmount(amount)) {
            return this.invalidAmountError(funcName);
        }

        if (amount > this.current_user.debet) {
            return this.log([`${this.current_type} ${this.current_user.number} `, this.messages.no_funds], funcName);
        }

        if (amount > this.cash) {
            return this.log([`${this.current_type} ${this.current_user.number} `, this.messages.another_amount], funcName);
        }

        this.current_user.debet -= amount;
        this.cash -= amount;
        this.log([`${this.current_type} ${this.current_user.number} `,
            `Successful withdraw of $${amount}, current balance: $${this.current_user.debet}`]);
    },

    // load cash - available for user only
    loadCash: function (amount) {
        const funcName = 'loadCash()';
        if (!this.checkUserType(this.current_type, 'user', funcName)) {
            return;
        }
        if (!this.isValidAmount(amount)) {
            return this.invalidAmountError(funcName);
        }
        this.current_user.debet += amount;
        this.cash += amount;
        this.log([`${this.current_type} ${this.current_user.number} `,
            `Added $${amount}. Current balance: $${this.current_user.debet}`]);
    },

    // load cash to ATM - available for admin only - EXTENDED
    load_cash: function (addition) {
        const funcName = 'load_cash()';
        if (!this.checkUserType(this.current_type, 'admin', funcName)) {
            return;
        }

        if (!this.isValidAmount(addition)) {
            return this.invalidAmountError(funcName);
        }

        this.cash += addition;
        this.log([`${this.current_type} ${this.current_user.number} `, `${this.messages.atm_load_cash}${this.cash}`]);
    },

    // get report about cash actions - available for admin only - EXTENDED
    getReport: function () {
        const funcName = 'getReport()';
        if (!this.checkUserType(this.current_type, 'admin', funcName)) {
            return;
        }
        console.log(this.logs.join(''));
    },

    // log out
    logout: function () {
        this.log([`${this.current_type} ${this.current_user.number} `, this.messages.logout]);
        this.is_auth = this.current_user = this.current_type = false;
    },

    isPositiveInt: value => (Number.isInteger(value) && value > 0),

    isValidAmount: function (amount) {
        return amount != undefined && this.isPositiveInt(amount);
    },

    log: function (params, funcName = '') {
        let logDate = new Date().toLocaleString('en-GB', this.date_time_options);
        const separator = ' | ';
        params.reduce(function () {
            logDate += separator + params[0] + ' ' + funcName + ' ' + params[1] + '\n';
        });
        console.log(params[1]);
        this.logs.push(logDate);

    },

    checkUserType: function (currentType, neededType, funcName) {
        if (currentType != neededType) {
            switch (currentType) {
                case false :
                    console.log(this.messages.non_authorized);
                    break;
                case 'admin' :
                case 'user' :
                    this.userTypeError(funcName);
                    break;
            }
        }

        return currentType === neededType;
    },

    userTypeError: function (funcName) {
        this.log([`${this.current_type} ${this.current_user.number}`, this.messages.user_type], funcName);
    },

    invalidAmountError: function (funcName) {
        this.log([`${this.current_type} ${this.current_user.number}`, this.messages.amount], funcName);
    },

    isValidLoginData: function (params) {
        return params.every(elem => typeof(elem) === 'string' && /^\d+$/.test(elem));
    }
};
