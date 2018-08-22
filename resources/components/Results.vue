<template>
    <div class="quiz__result">{{result}}</div>

</template>
<script>
    export default {
        name: 'Results',
        computed: {
            result: {
                get() {
                    return this.$store.state.result;
                }
            }
        }
    }


</script>