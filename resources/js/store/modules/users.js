import Vue from "vue";
import axios from 'axios'

const state = {
    users:[]
}

const actions = {
    requestUsers({commit}){
        axios.get('/adminusers')
        .then(({data}) => {
            commit('setUsers', data)
        })
      }
}
const mutations = {
    setUsers: (state, data) => { state.users = data}
}
const getters = {
    getUsers:state => state.users
    
}

export default {
    state,
    actions,
    mutations,
    getters
}