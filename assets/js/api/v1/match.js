import { symfonyFetch } from '../../utility/symfonyFetch'

export function getMatches() {
    return symfonyFetch('/api/v1/matches', 'GET')
}

export function updateMatch(id, data) {
    return symfonyFetch(`/api/v1/matches/${id}`, 'PUT', data)
}

export function deleteMatch(id) {
    return symfonyFetch(`/api/v1/matches/${id}`, 'DELETE')
}

export function createMatch(data) {
    return symfonyFetch('/api/v1/matches', 'POST', data)
}