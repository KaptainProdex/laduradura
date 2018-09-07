<template>
    <div>
        <table class="table is-fullwidth is-hoverable">
            <thead>
            <tr>
                <th>Map</th>
                <th>Heroes</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="match, index in matches">
                <td>
                    <span v-if="!match.edit">
                      {{ $parent.maps[match.map].name }}
                    </span>
                    <span v-else>
                      <select class="select" v-model="match.map">
                          <option v-for="map, index in $parent.maps" :value="index">
                              {{ map.name }}
                          </option>
                      </select>
                    </span>
                </td>
                <td>
                    <span v-if="!match.edit">
                      <ul>
                            <li v-for="hero in match.heroes">
                                {{ $parent.heroes[hero].name }}
                            </li>
                      </ul>
                    </span>
                    <span v-else>
                      <ul>
                          <li v-for="hero in $parent.heroes">
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
                        <button class="button is-success" @click="matchCreate(match)">
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
            </tbody>
        </table>
        <button class="button" @click="addNewMatch">
            Add New Match
        </button>
    </div>
</template>

<script>
    import { updateMatch, deleteMatch, createMatch } from "../api/v1/match";

    export default {
        name: 'match-table',
        props: ['matches'],
        methods: {
            addNewMatch: function() {
                this.matches.unshift({
                    new: true,
                    edit: true,
                    heroes: [],
                    id: (this.matches.length + 1),
                    map: 0,
                    season: 1
                })
            },
            matchClick: function(match) {
                if (match.edit) {
                    let data = {
                        map: match.map,
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
            deleteMatch: function(match, index) {
                deleteMatch(match.id)
                this.$parent.matches.splice(index, 1)
            },
            cancelMatch: function(index) {
                this.matches.splice(index, 1)
            },
            matchCreate: function(match) {
                let data = {
                    map: match.map,
                    heroes: match.heroes,
                    season: match.season
                }

                createMatch(data).then(function (response) {
                    match.id = response.id
                    match.new = false
                    match.edit = false
                })
            }
        }
    }
</script>

<style scoped>

</style>