import { defineStore } from 'pinia'
import { authAPI } from '@/services/api'

const auth_storage = {
    auth: localStorage.getItem('auth'),
    email: localStorage.getItem('auth.email'),
    role: localStorage.getItem('auth.role'),
    point: localStorage.getItem('auth.point'),
    name: localStorage.getItem('auth.name'),
    id : localStorage.getItem('auth.id'),
}

export const useAuthStore = defineStore({
    id: 'auth',
    state: () => {
        return {
            auth: {
                email: auth_storage.email,
                role: auth_storage.role,
                point: auth_storage.point,
                name: auth_storage.name,
                id : auth_storage.id,
            }
        }
        // return {
        //     auth: []
        // }
    },

    getters: {
        getAuth: (state) => state.auth,
        getName: (state) => state.auth.name ,
        getEmail: (state) => state.auth.email,
        getRole: (state) => state.auth.role,
        getId: (state) => state.auth.id,
        getPoint: (state) => state.auth.point,

    isAuthen(state) {
      return state.auth.email != null
    }
  },

  actions: {
    async login (email, password) {
      if (await authAPI.login(email, password)) {
        this.fetch()
        return true
      }
      return false
    },

        async fetch() {
            this.auth = await authAPI.me()
            localStorage.setItem('auth.email', this.auth.email)
            localStorage.setItem('auth.role', this.auth.role)
            localStorage.setItem('auth.point', this.auth.point)
            localStorage.setItem('auth.name', this.auth.name)
            localStorage.setItem('auth.id', this.auth.id)
        },

        async add(user) {
            const response = await authAPI.saveNew(user)
            if (response.success) {
                this.auth.push({
                    ...user
                })
                return response.user_id
            }
            return false
        },

    logout () {
      authAPI.logout()
      localStorage.removeItem('auth.email')
      localStorage.removeItem('auth.role')
      localStorage.removeItem('auth.id')
        localStorage.removeItem('auth.point')
        localStorage.removeItem('auth.name')
      this.auth = {
        email: null,
        role: null,
        id: null,
        name: null,
        point: null,
      }
    }
  }
})
