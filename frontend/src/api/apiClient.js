/**
 * API Client Configuration
 *
 * This module creates and exports a preconfigured Axios instance
 * for communicating with the backend API.
 *
 */

import axios from 'axios'

const apiClient = axios.create({
  // Temporary base URL (local development)
  baseURL: 'http://localhost/dashboard/PhotoVault/PhotoVault/backend/public/api',
  headers: {
    'Content-Type': 'application/json',
  },
})

// Attach authentication token to every request if present
apiClient.interceptors.request.use((config) => {
  const token = localStorage.getItem('token')
  if (token) {
    config.headers.Authorization = `Bearer ${token}`
  }
  return config
})
export default apiClient
