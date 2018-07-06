import { symfonyFetch } from '../../utility/symfonyFetch'

export function getHeroes() {
    return symfonyFetch('/api/v1/heroes', 'GET')
}