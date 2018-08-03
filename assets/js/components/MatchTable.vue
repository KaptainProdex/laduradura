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
            <tr v-for="match in matches">
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
                    <button class="button is-link" :class="{'is-success': match.edit}"
                            @click="match.edit = !match.edit">
                          <span v-if="!match.edit">
                            Edit
                          </span>
                          <span v-else>
                            Save
                          </span>
                    </button>
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
    export default {
        name: 'match-table',
        props: ['matches'],
        methods: {
            addNewMatch: function() {
                this.matches.unshift({
                    edit: true,
                    heroes: [],
                    id: (this.matches.length + 1),
                    map: 0,
                    season: 1
                })
            }
        }
    }
</script>

<style scoped>

</style>