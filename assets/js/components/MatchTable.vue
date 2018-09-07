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
                <MatchTableRow v-for="match, index in matches" :match="match" :index="index" :key="index"/>
            </tbody>
        </table>
        <button class="button" @click="addNewMatch">
            Add New Match
        </button>
    </div>
</template>

<script>
    import MatchTableRow from './MatchTableRow'

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
        },
        components: {
            MatchTableRow
        }
    }
</script>

<style scoped>

</style>