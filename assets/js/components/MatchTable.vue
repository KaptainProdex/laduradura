<template>
    <div>
        <table class="table is-fullwidth is-hoverable">
            <thead>
            <tr>
                <th>Map</th>
                <th>+ / -</th>
                <th>Season Rank</th>
                <th>Heroes</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
                <component :is="match.edit ? 'MatchTableEditRow' : 'MatchTableDisplayRow'" v-for="match, index in matches" :match="match" :index="index" :key="index"/>
            </tbody>
        </table>
        <button class="button" @click="addNewMatch">
            Add New Match
        </button>
    </div>
</template>

<script>
    import MatchTableDisplayRow from './MatchTableDisplayRow'
    import MatchTableEditRow from './MatchTableEditRow'

    export default {
        name: 'match-table',
        props: ['matches'],
        methods: {
            addNewMatch: function() {
                this.matches.unshift({
                    new: true,
                    edit: true,
                    seasonRank: null,
                    heroes: [],
                    id: (this.matches.length + 1),
                    map: 0,
                    season: 1
                })
            },
        },
        components: {
            MatchTableEditRow,
            MatchTableDisplayRow
        }
    }
</script>

<style scoped>

</style>