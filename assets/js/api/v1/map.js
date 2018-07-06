import { symfonyFetch } from '../../utility/symfonyFetch'

export function getMaps() {
    return symfonyFetch('/api/v1/maps', 'GET')
}