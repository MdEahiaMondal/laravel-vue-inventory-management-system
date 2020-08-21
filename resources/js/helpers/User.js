import TokenVerify from "./TokenVerify";
import AppStorage from "./AppStorage";

class User{
    responseAfterLogin(res){
        const access_token = res.data.access_token
        const username = res.data.name
        if (TokenVerify.isValid(access_token)){
            AppStorage.store(access_token,username)
        }
    }

    hasToken(){
        const token = localStorage.getItem('token')
        if (token){
            return TokenVerify.isValid(token) ? true : false
        }
        false
    }

    loggedIn(){
        return this.hasToken()
    }

    name(){
        if (this.loggedIn()){
            return localStorage.getItem('user')
        }
    }

    id(){
        if (this.loggedIn()){
            const payload = TokenVerify.payload(localStorage.getItem('token'))
            return payload.sub
        }
        return  false
    }

}

export default User = new User()
