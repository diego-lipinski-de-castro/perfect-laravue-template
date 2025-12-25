import http from '@/utils/http'

export interface User {
  id: number
  name: string
  email: string
  email_verified_at: string | null
  created_at: string
  updated_at: string
}

export interface AuthResponse {
  message: string
  user: User
  token: string
}

export interface MeResponse {
  message: string
  user: User
}

export interface LoginParams {
  email: string
  password: string
}

export interface RegisterParams {
  name: string
  email: string
  password: string
}

export async function login(params: LoginParams): Promise<AuthResponse> {
  const response = await http.post<AuthResponse>('/api/login', params)
  return response.data
}

export async function register(params: RegisterParams): Promise<AuthResponse> {
  const response = await http.post<AuthResponse>('/api/register', params)
  return response.data
}

export async function me(): Promise<MeResponse> {
  const response = await http.get<MeResponse>('/api/me')
  return response.data
}
