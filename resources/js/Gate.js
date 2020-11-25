export default class Gate{
    constructor(user){
        this.user = user;
    }

    
    isAdmin(){
        return this.user.type === 'admin';
    }
    isStandard(){
        return this.user.type === 'standard';
    }
    isAuthor(){
        return this.user.type === 'author';
    }
    isAdminOrAuthor(){
        if(this.user.type === 'admin' || this.user.type === 'author'){
            return true
        }
        
    }
}