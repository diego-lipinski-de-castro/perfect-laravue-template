import axios from "axios";

const http = axios.create({
  baseURL: import.meta.env.VITE_API_URL,
  headers: {
    'Content-Type': 'application/json',
    'Accept': 'application/json',
  },
});

http.interceptors.request.use((config) => {
  const token = localStorage.getItem('token')

  if (token) {
    config.headers.Authorization = `Bearer ${token}`
  }

  return config
}, (error) => {
  return Promise.reject(error)
})

http.interceptors.response.use((response) => {
  if (response.status === 401) {
    localStorage.removeItem('token')
  }

  return response
}, (error) => {
  return Promise.reject(error)
})

export default http;
