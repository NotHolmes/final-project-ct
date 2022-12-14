import axios from 'axios'

const axiosInstance = axios.create({
    baseURL: 'http://localhost/api'
})

const JWT_TOKEN_LOCALSTORAGE_KEY = 'jwt_token'
const token = localStorage.getItem(JWT_TOKEN_LOCALSTORAGE_KEY)

axiosInstance.defaults.headers.common['Accept'] = 'application/json;charset=UTF-8';
axiosInstance.defaults.headers.common['Content-Type'] = 'application/json;charset=UTF-8';
if (token) {
    axiosInstance.defaults.headers.common['Authorization'] = 'Bearer ' + token
}

export const authAPI = {
    async login(email, password) {
        const response = await axiosInstance.post('/auth/login', {
            email,
            password
        })
        if (response.status == 200) {
            localStorage.setItem(JWT_TOKEN_LOCALSTORAGE_KEY, response.data.access_token)
            return true
        }
        return false
    },
    async me() {
        const _token = localStorage.getItem(JWT_TOKEN_LOCALSTORAGE_KEY)
        if (_token) {
            axiosInstance.defaults.headers.common['Authorization'] = 'Bearer ' + _token
        }
        const response = await axiosInstance.post('/auth/me')
        if (response.status == 200) {
            return response.data.data
        }
        return {}
    },
    logout() {
        localStorage.removeItem(JWT_TOKEN_LOCALSTORAGE_KEY)
    },


    async saveNew(user) {
        const response = await axiosInstance.post('/auth/register', user)
        if (response.status === 201) {
            return response.data
        }
        return {
            success: false
        }
    },
}

export const rewardAPI = {
  async getAll () {
    const response = await axiosInstance.get('/rewards')
    if (response.status == 200) {
      return response.data.data
    }
    return []
  },
  async saveNew (reward) {
    reward.balance = reward.total_amount
    reward.is_active = true
    const response = await axiosInstance.post('/rewards', reward)
    if (response.status == 201) {
      return response.data
    }
    return {
      success: false
    }
  }
}

export const postAPI = {
    async getAll() {
        console.table(localStorage.getItem('jwt_token'))
        if(localStorage.getItem('jwt_token') !== null) {
            const response = await axiosInstance.get('/posts', {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem('jwt_token')}`
                }
            })
            if (response.status === 200) {
                return response.data.data
            }
        } else {
            const response = await axiosInstance.get('/posts')
            if (response.status === 200) {
                return response.data.data
            }
        }
        return []
    },
    async saveNew(post) {
        const response = await axiosInstance.post('/posts', post, {
            headers: {
                'Content-Type': 'multipart/form-data',
                'Authorization': `Bearer ${localStorage.getItem('jwt_token')}`

            }
        })
        if (response.status === 201) {
            return response.data
        }
        return {
            success: false
        }
    },
    async search(query) {
        const response = await axiosInstance.get('/posts/search', {
            params: {
                query: query
            }
        })
        if (response.status === 200) {
            return response.data.data
        }
        return []
        }
}

export const categoryAPI = {
    async getAll() {
        const response = await axiosInstance.get('/categories')
        if (response.status === 200) {
            return response.data.data
        }
        return []
    },
    async saveNew(category) {
        const response = await axiosInstance.post('/categories', category)
        if (response.status === 201) {
            return response.data
        }
        return {
            success: false
        }
    }
}

export const userAPI = {
    async getAll() {
        const response = await axiosInstance.get('/contracts')
        if (response.status === 200) {
            return response.data.data
        }
        return []
    },
    async saveNew(user) {
        const response = await axiosInstance.post('/contracts', user)
        if (response.status === 201) {
            return response.data
        }
        return {
            success: false
        }
    }
}
