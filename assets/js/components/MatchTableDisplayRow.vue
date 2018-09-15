<template>
    <tr>
        <td>
            {{ $parent.$parent.maps[match.map].name }}
        </td>
        <td>
            {{ seasonRankDiff(match, index) }}
        </td>
        <td>
            <span v-if="match.seasonRank">
                {{ match.seasonRank }}
            </span>
            <span v-else>
                - / -
            </span>
        </td>
        <td>
            <ul>
                <li v-for="hero in match.heroes">
                    {{ $parent.$parent.heroes[hero].name }}
                </li>
            </ul>
        </td>
        <td>
            <button class="button is-link"
                    @click="matchClick(match)">
                Edit
            </button>
        </td>
    </tr>
</template>

<script>
    import {updateMatch, deleteMatch, createMatch} from "../api/v1/match"

    export default {
        name: 'match-table-display-row',
        props: ['match', 'index'],
        methods: {
            matchClick: function (match) {
                match.edit = !match.edit
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