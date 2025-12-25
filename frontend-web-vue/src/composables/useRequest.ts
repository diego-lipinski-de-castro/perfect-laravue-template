import http from '@/utils/http'
import { useAxios } from '@vueuse/integrations'
import type { AxiosRequestConfig } from 'axios'

type UseRequestOptions = {
  url: string
  config: AxiosRequestConfig
}

export function useRequest(options: UseRequestOptions) {
  const { data: value, error, isLoading, execute: submit } = useAxios(options.url, options.config, http, {
    immediate: false,
  })

  return {
    value,
    error,
    isLoading,
    submit,
  }
}
