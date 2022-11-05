import { defineStore } from 'pinia'
import { authAPI } from '@/services/api'

const auth_storage = {
    id: localStorage.getItem('auth.id'),
  email: localStorage.getItem('auth.email'),
}

export const useAuthStore = defineStore({
  id: 'auth',
  state: () => {
    return {
      auth: {
          id: auth_storage.id,
        email: auth_storage.email,
      }
    }
  },

  getters: {
    getAuth: (state) => state.auth,

    getEmail: (state) => state.auth.email,

      getId: (state) => state.auth.id,

    isAuthen (state) {
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

    async fetch () {
      this.auth = await authAPI.me()
      localStorage.setItem('auth.email', this.auth.email)
        localStorage.setItem('auth.id', this.auth.id)
    },

    logout () {
      authAPI.logout()
      localStorage.removeItem('auth.email')
      localStorage.removeItem('auth.id')
      this.auth = {
        email: null,
          id: null,
      }
    }
  }
})
