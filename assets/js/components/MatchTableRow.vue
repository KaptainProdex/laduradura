<template>
    <tr>
        <td>
            <span v-if="!match.edit">
                {{ $parent.$parent.maps[match.map].name }}
            </span>
            <span v-else>
                <select class="select" v-model="match.map">
                  <option v-for="map, index in $parent.$parent.maps" :value="index">
                      {{ map.name }}
                  </option>
                </select>
            </span>
        </td>
        <td>
            <span v-if="!match.edit">
                {{ seasonRankDiff(match, index) }}
            </span>
        </td>
        <td>
            <span v-if="!match.edit">
                <span v-if="match.seasonRank">
                    {{ match.seasonRank }}
                </span>
                <span v-else>
                    - / -
                </span>
            </span>
            <span v-else>
                    <input class="input" type="number" v-model="match.seasonRank">
            </span>
        </td>
        <td>
            <span v-if="!match.edit">
                <ul>
                    <li v-for="hero in match.heroes">
                        {{ $parent.$parent.heroes[hero].name }}
                    </li>
                </ul>
            </span>
            <span v-else>
                <ul>
                    <li v-for="hero in $parent.$parent.heroes">
                        <label class="checkbox">
                            <input type="checkbox" class="checkbox" :value="hero.id" v-model="match.heroes">
                            {{ hero.name }}
                        </label>
                    </li>
                </ul>
            </span>
        </td>
        <td>
            <span v-if="match.new">
                <button class="button" @click="cancelMatch(index)">
                    Cancel
                </button>
                <button class="button is-success" @click="matchCreate(match, index)">
                    Create
                </button>
            </span>
            <span v-else>
                <span v-if="match.edit">
                <button class="button is-danger" @click="deleteMatch(match, index)">
                    Delete
                </button>
                </span>
                <button class="button is-link" :class="{'is-success': match.edit}"
                        @click="matchClick(match)">
                    <span v-if="!match.edit">
                        Edit
                    </span>
                    <span v-else>
                        Save
                    </span>
                </button>
            </span>
        </td>
    </tr>
</template>

<script>
    import {updateMatch, deleteMatch, createMatch} from "../api/v1/match"

    export default {
        name: 'match-table-row',
        props: ['match', 'index'],
        methods: {
            matchClick: function (match) {
                if (match.edit) {
                    let data = {
                        map: match.map,
                        seasonRank: match.seasonRank,
                        heroes: match.heroes,
                        season: match.season
                    }

                    updateMatch(match.id, data).then(function (response) {
                        match.edit = false
                    })
                } else {
                    match.edit = true
                }
            },
            deleteMatch: function (match, index) {
                deleteMatch(match.id)
                this.$parent.$parent.matches.splice(index, 1)
            },
            cancelMatch: function (index) {
                this.$parent.matches.splice(index, 1)
            },
            matchCreate: function (match, index) {
                let data = {
                    map: match.map,
                    seasonRank: match.seasonRank,
                    heroes: match.heroes,
                    season: match.season
                }

                createMatch(data).then(function (response) {
                    match.id = response.id
                    match.new = false
                    match.edit = false
                })

            },
            seasonRankDiff(match, index) {
                let diff = 0;
                let currentMatch = match.seasonRank
                let previousMatch = 0;
                if (this.$parent.matches.length <= index) {
                    diff = '- / -'
                } else {
                    previousMatch = this.$parent.matches[index + 1].seasonRank
                    diff = currentMatch - previousMatch
                    if (diff === 0) diff = '- / -'
                }
                return diff;
            }
        }
    }
</script>

<style>

</style>