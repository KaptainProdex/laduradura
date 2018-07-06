<template>
       <div v-if="
        loading.maps &&
        loading.heroes &&
        loading.seasons &&
        loading.matches
        ">
           <p>Loading ...</p>
       </div>
       <div v-else>
           <MatchTable :matches="matches"></MatchTable>
       </div>
</template>

<script>
import { getMatches } from '../api/v1/match'
import { getSeasons } from '../api/v1/season'
import { getHeroes  } from '../api/v1/hero'
import { getMaps }    from '../api/v1/map'

import { responseTransformer} from '../utility/responseTransformer'

import MatchTable from './MatchTable'

export default {
    name: "match-table-container",
    data: () => {
        return {
            loading: {
                maps: true,
                heroes: true,
                matches: true,
                seasons: true
            },
            matches: [],
            seasons: {},
            heroes: {},
            maps: {}
        }
    },
    created: function () {
        const self = this

        getMaps().then(function (maps) {
            responseTransformer(self.maps, maps)
            self.loading.maps = false
        })

        getHeroes().then(function (heroes) {
            responseTransformer(self.heroes, heroes)
            self.loading.heroes = false
        })

        getSeasons().then(function (seasons) {
            responseTransformer(self.seasons, seasons)
            self.loading.seasons = false
        })

        getMatches().then(function (matches) {
            matches.forEach(function (match) {
                match['edit'] = false

                let mHeroes = []
                match.heroes.forEach(function(hero) {
                    mHeroes.push(hero.id)
                })
                match.heroes = mHeroes
            })

            self.matches = matches
            self.loading.matches = false
        })
    },
    components: {
        MatchTable
    }
}
</script>

<style scoped>

</style>