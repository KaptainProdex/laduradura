import { symfonyFetch } from '../../utility/symfonyFetch'

export function getMatches() {
    return symfonyFetch('/api/v1/matches', 'GET')
}