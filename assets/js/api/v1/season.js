import { symfonyFetch } from '../../utility/symfonyFetch'

export function getSeasons() {
    return symfonyFetch('/api/v1/seasons', 'GET')
}