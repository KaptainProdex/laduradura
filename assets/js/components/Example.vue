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
           <ul>
               <li v-for="match in matches">
                   <b>Match ID:</b> {{ match.id }} <br/>
                   <b>Season:</b> {{ seasons[match.season].number }} <br/>
                   <b>Heroes:</b>
                   <span v-for="hero in match.heroes">
                       {{ heroes[hero.id].name }}
                   </span><br/>
               </li>
           </ul>
       </div>
</template>

<script>
import { getMatches } from '../api/v1/match'
import { getSeasons } from '../api/v1/season'
import { getHeroes  } from '../api/v1/hero'
import { getMaps }    from '../api/v1/map'

import { responseTransformer} from '../utility/responseTransformer'

export default {
    name: "example",
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
            self.matches = matches
            self.loading.matches = false
        })
    }
}
</script>

<style scoped>

</style>