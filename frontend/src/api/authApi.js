/**
 * Authentication API Service
 *
 * Provides functions for handling user authentication requests to the backend API.
 *
 * Responsibilities:
 * - User login
 * - User registration
 * - Token validation
 *
 * All requests are made using the centralized apiClient.
 */

import apiClient from '@/api/apiClient'

export async function login(payload) {
  const { data } = await apiClient.post('/login', payload)
  return data
}

export async function register(payload) {
  const { data } = await apiClient.post('/register', payload)
  return data
}
export async function checkToken() {
  const { data } = await apiClient.get('/check')
  return data
}
